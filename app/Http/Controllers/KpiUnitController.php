<?php

namespace App\Http\Controllers;

use App\Models\Kpi;
use App\Models\KpiUnit;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use DB;

class KpiUnitController extends Controller
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
		$data = KpiUnit::paginate(PAGINATION);
		return view('kpiunit.index', ['data' => $data, 'request' => $request]);
	}

	/**
	* Show the form for creating a new resource.
	*
	* @return \Illuminate\Http\Response
	*/
	public function create()
	{
	  return view('kpiunit.create');
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
	      	'name' => 'bail|required|max:191|unique:kpi_unit',
	      ],
	      self::validationMsg()
	  );

	  if ($validator->fails()) {
	      return back()->withErrors($validator)->withInput();
	  }

	  $post = KpiUnit::create([
	      'name' => $request->name,
	  ]);

	  return redirect('kpiunit')->with('success', trans('titles.createSuccess'));
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
	  // $data = KpiUnit::find($id);

	  // return view('kpiunit.show')->withUser($user);
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
	  $data = KpiUnit::findOrFail($id);

	  return view('kpiunit.edit')->with(['data' => $data]);
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
	  $data = KpiUnit::find($id);

	  $rules = [
	      'name' => 'bail|required|max:191',
	  ];

	  $validator = Validator::make($request->all(), $rules, self::validationMsg());

	  if ($validator->fails()) {
	      return back()->withErrors($validator)->withInput();
	  }

	  $data->update([
	      'name' => $request->name,
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
	  $data = KpiUnit::findOrFail($id);

	  if(!empty($data)) {
	  		// check unit in kpi table
	  		$kpi = Kpi::where('unit', $id)->first();
	  		if(!empty($kpi)) {
	  			return back()->with('error', trans('titles.deleteError') . '. Đơn vị tính đang được sử dụng.');
	  		}

	     	$data->delete();

	      return redirect('kpiunit')->with('success', trans('titles.deleteSuccess'));
	  }

	  return back()->with('error', trans('titles.deleteError'));
	}

}
