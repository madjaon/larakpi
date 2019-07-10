<?php

namespace App\Http\Controllers;

use App\Models\Kpi;
use App\Models\KpiCode;
use App\Helpers\CommonOption;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use DB;

class KpiCodeController extends Controller
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
	      ];
	}

	/**
	* Display a listing of the resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function index(Request $request)
	{
		$data = KpiCode::paginate(PAGINATION);

		return view('kpicode.index', ['data' => $data, 'request' => $request]);
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
	  return view('kpicode.create');
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
	  $validator = Validator::make($request->all(),
	      [
	      	'name' => 'bail|required|max:191|unique:kpi_code',
	      ],
	      self::validationMsg()
	  );

	  if ($validator->fails()) {
	      return back()->withErrors($validator)->withInput();
	  }

	  $post = KpiCode::create([
	      'name' => $request->name,
	      'config' => $request->config,
	  ]);

	  return redirect('kpicode')->with('success', trans('titles.createSuccess'));
	}

	/**
	* Display the specified resource.
	*
	* @param int $id
	*
	* @return \Illuminate\Http\Response
	*/
	public function show($id)
	{
	  // $data = KpiCode::find($id);

	  // return view('kpicode.show')->withUser($user);
	}

	/**
	* Show the form for editing the specified resource.
	*
	* @param int $id
	*
	* @return \Illuminate\Http\Response
	*/
	public function edit($id)
	{
	  	$data = KpiCode::findOrFail($id);

	  	return view('kpicode.edit')->with(['data' => $data]);
	}

	/**
	* Update the specified resource in storage.
	*
	* @param \Illuminate\Http\Request $request
	* @param int                      $id
	*
	* @return \Illuminate\Http\Response
	*/
	public function update(Request $request, $id)
	{
	  	$data = KpiCode::find($id);

	  $rules = [
	      'name' => 'bail|required|max:191',
	  ];

	  $validator = Validator::make($request->all(), $rules, self::validationMsg());

	  if ($validator->fails()) {
	      return back()->withErrors($validator)->withInput();
	  }

	  $data->update([
	      'name' => $request->name,
	      'config' => $request->config,
	  ]);

	  return back()->with('success', trans('titles.updateSuccess'));
	}

	/**
	* Remove the specified resource from storage.
	*
	* @param int $id
	*
	* @return \Illuminate\Http\Response
	*/
	public function destroy($id)
	{
	  $data = KpiCode::findOrFail($id);

	  if(!empty($data)) {
	  		// check code in kpi table
	  		$kpi = Kpi::where('code', $id)->first();
	  		if(!empty($kpi)) {
	  			return back()->with('error', trans('titles.deleteError') . '. Mã KPI đang được sử dụng.');
	  		}

	     	$data->delete();

	      return redirect('kpicode')->with('success', trans('titles.deleteSuccess'));
	  }

	  return back()->with('error', trans('titles.deleteError'));
	}

}
