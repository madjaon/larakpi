<?php

namespace App\Http\Controllers;

use App\Models\Kpi;
use App\Models\KpiCode;
use App\Models\KpiEfficiency;
use App\Models\User;
use App\Helpers\CommonOption;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use jeremykenedy\LaravelRoles\Models\Role;
use Illuminate\Validation\Rule;
use Validator;
use DB;

class KpiController extends Controller
{
	/**
	* Create a new controller instance.
	*
	* @return void
	*/
	public function __construct()
	{
		$this->middleware('auth');
	}

	private function validationMsg()
	{
		return [
				'name.required' => trans('validation.required'),
				'name.max'      => trans('validation.max.string'),
				'name.unique'   => trans('validation.unique'),
				'code.unique'   => trans('validation.unique'),
				'unit.unique'   => trans('validation.unique'),
				'trend.unique'  => trans('validation.unique'),
	      ];
	}

	/**
	* Show the application dashboard.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index()
	{
  		// return view('home');
  		
  		$userId = Auth::id();

  		$user = User::find($userId);

  		$data = Kpi::where('user_id', $userId)->get();

      $totalPercent = $data->sum('percent');

      $dataE = KpiEfficiency::where('user_id', $userId)->first();

      return view('kpi.show', [
      	'data' => $data, 
      	'totalPercent' => $totalPercent, 
      	'dataE' => $dataE,
      	'user' => $user
      ]);
	}

	/**
	 * Danh sach KPI users
	 * @return [type] [description]
	 */
	public function listUsers()
	{
  		$pagintaionEnabled = config('usersmanagement.enablePagination');
		if ($pagintaionEnabled) {
		   $users = User::paginate(config('usersmanagement.paginateListSize'));
		} else {
		   $users = User::all();
		}
		$roles = Role::all();

		return View('kpi.index', compact('users', 'roles'));
	}

	/**
     * Hien thi bang KPI theo user id
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
	public function show($userId)
	{
		$user = User::find($userId);

		$data = Kpi::where('user_id', $userId)->get();

      $totalPercent = $data->sum('percent');

      $dataE = KpiEfficiency::where('user_id', $userId)->first();

      return view('kpi.show', [
      	'data' => $data, 
      	'totalPercent' => $totalPercent, 
      	'dataE' => $dataE,
      	'user' => $user
      ]);
	}

	/**
	* Store a newly created resource in storage.
	*
	* @param \Illuminate\Http\Request $request
	*
	* @return \Illuminate\Http\Response
	*/
	public function store(Request $request)
	{
		$userId = $request->user_id;

		$validator = Validator::make($request->all(),
		   [
				'name'  => ['bail', 'required', 'max:191', 
								Rule::unique('kpis', 'name')->where('user_id', $userId),
							],
				'code'  => 'required',
				'unit'  => 'required',
				'trend' => 'required',
		   ],
		   self::validationMsg()
		);

		if ($validator->fails()) {
		   return back()->withErrors($validator)->withInput();
		}

		$data = Kpi::create([
			'name'    => $request->name,
			'code'    => $request->code,
			'unit'    => $request->unit,
			'trend'   => $request->trend,
			'user_id' => $userId,
		]);

		// neu chua co tong hieu suat thi tao moi cho user id
		$dataE  = KpiEfficiency::where('user_id', $userId)->first();
		if(empty($dataE)) {
			KpiEfficiency::create(['user_id' => $userId]);
		}

		return redirect('kpi/' . $request->user_id)->with('success', trans('titles.createSuccess'));
		
	}

	public function updatePerform(Request $request)
 	{
		$idArray      = $request->idArray;
		$percentArray = $request->percentArray;
		$targetArray  = $request->targetArray;
		$performArray = $request->performArray;
     	$per = array();

		if($idArray && $percentArray && $targetArray && $performArray) {
			foreach($idArray as $key => $value) {
				$data = Kpi::find($value);
				if(!empty($data)) {

					$target[$key]  = is_numeric($targetArray[$key])?$targetArray[$key]:null;
					$percent[$key] = is_numeric($percentArray[$key])?$percentArray[$key]:null;
					$data->update([
								'percent' => $percent[$key],
								'target'  => $target[$key],
						]);

					// chi tieu giao khac 0
					if(!empty($target[$key]) && !empty($performArray[$key])) {
				 		if($data->trend == 1) {
				 			// chieu huong tang: % thuc hien = [thuchien / chitieu] x 100
				 			$per[$key] = round(($performArray[$key] / $target[$key]) * 100, 2);
				 		} else {
				 			// chieu huong giam: % thuc hien = [chitieu / thuchien] x 100
			 				$per[$key] = round(($target[$key] / $performArray[$key]) * 100, 2);
				 		}
					} else {
							// chi tieu giao bang 0
							$per[$key] = null;
					}
				  	$data->update([
									'perform'     => is_numeric($performArray[$key])?$performArray[$key]:null,
									'per_perform' => $per[$key],
			     	]);
				}
			}
			return $per;
		}
		return 0;
    }

    public function updateScores(Request $request)
    {
    	$userId = $request->user_id;

    	$data = Kpi::where('user_id', $userId)->get();
    	if(!empty($data)) {

			$scores     = array();
			$efficiency = array();

    		foreach($data as $key => $value) {
    			
    			// chi tieu giao khac 0
    			if(!empty($value->target)) {
					$perPerform       = !empty($value->per_perform)?$value->per_perform:0;
					$scores[$key]     = CommonOption::getScore($perPerform);
					$efficiency[$key] = $perPerform;
    			} else {
    				// chi tieu giao bang 0 hoac null
    				// tinh diem theo cau hinh thang do
					$scores[$key]     = self::getScoreByPerform($value->code, $value->perform);
					$efficiency[$key] = CommonOption::getEfficiency($scores[$key]);
    			}
    			$value->update([
									'score'      => $scores[$key],
									'efficiency' => $efficiency[$key]
			        ]);
    		}

			// tong hieu suat
			$totalE = Kpi::where('user_id', $userId)->get()->sum('efficiency');
			$countKpi = Kpi::where('user_id', $userId)->get()->count();
			$total  = round($totalE / $countKpi, 2);
			$score  = CommonOption::getScore($total);
			$rank   = CommonOption::getRank($score);
			$dataE  = KpiEfficiency::where('user_id', $userId)->first();
			if(!empty($dataE)) {
				$dataE->update(['total' => $total, 'rank' => $score]);
			} else {
				KpiEfficiency::create(['user_id' => $userId, 'total' => $total, 'rank' => $score]);
			}

			$rs = [
						'scores'     => $scores,
						'efficiency' => $efficiency,
						'total'      => $total,
						'rank'       => $rank
					];
        	return response()->json($rs);
    	}
      return 0;
 	}


   public function updateTarget(Request $request)
   {
		$idArray     = $request->idArray;
		$targetArray = $request->targetArray;
		$target      = array();

		if($idArray && $targetArray) {
			foreach($idArray as $key => $value) {
				$data = Kpi::find($value);
				if(!empty($data)) {

					$target[$key]  = is_numeric($targetArray[$key])?$targetArray[$key]:null;
					$data->update([
								'target' => $target[$key],
						]);
				}
			}
			return $target;
		}
		return 0;
   }

    /**
	* Remove the specified resource from storage.
	*
	* @param int $id
	*
	* @return \Illuminate\Http\Response
	*/
	public function destroy($id, Request $request)
	{
	  $data = Kpi::findOrFail($id);

	  if(!empty($data)) {
	     	$data->delete();

	      return redirect('kpi/' . $request->user_id)->with('success', trans('titles.deleteSuccess'));
	  }

	  return back()->with('error', trans('titles.deleteError'));
	}

	/**
	 * KPI Code ID & perform -> Score
	 * @param  [type] $id [description]
	 * @return [type]     [description]
	 */
	private function getScoreByPerform($code, $perform)
	{
		$data = KpiCode::findOrFail($code);
		if(!empty($data) && !empty($data->config)) {
			$config = explode('|', $data->config);
			if(!empty($config)) {
				foreach($config as $key => $value) {
					$item = explode('-', $value);
					if($item[0] == $perform) {
						return $item[1];
					}
				}
			}
		}
		return 0;
	}

}
