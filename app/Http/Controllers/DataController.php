<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DataController extends Controller{

	public function index()
	{
		return view('index');
	}
	
	public function ReadService(Request $request,$table)
	{
		$take = $request->get('take');
		$skip = $request->get('skip');
		$sorts = $request->get('sort',array());
		$filters = $request->get('filter')['filters'];

		$query= DB::table($table);
		foreach($sorts as $sort) {
			$query->orderBy($sort['field'],$sort['dir']);
		}
		
		/*Filtering*/
		if ($f = $request->get('filter')) {
			foreach ($f['filters'] as $filter) {
				switch ($filter['operator']) {
					case 'eq': $filter['operator'] = '=';
						break;
					case 'neq': $filter['operator'] = '!=';
						break;
					case 'lt': $filter['operator'] = '<';
						break;
					case 'lte': $filter['operator'] = '<=';
						break;
					case 'gt': $filter['operator'] = '>';
						break;
					case 'gte': $filter['operator'] = '>=';
						break;
					case 'startswith':
						$filter['operator'] = 'LIKE';
						$filter['value'] = $filter['value'] . '%';
						break;
					case 'endswith':
						$filter['operator'] = 'LIKE';
						$filter['value'] = '%' . $filter['value'];
						break;
					case 'contains':
						$filter['operator'] = 'LIKE';
						$filter['value'] = '%' . $filter['value'] . '%';
						break;
					case 'doesnotcontain':
						$filter['operator'] = 'NOT LIKE';
						$filter['value'] = '%' . $filter['value'] . '%';
						break;
				}
				$query->where($filter['field'],$filter['operator'],$filter['value']);
			}
		}
		
		/*Sorting & Paging*/
		$query->skip($skip)->take($take);

		/*Count Records*/
		$Data['Total'] = $query->count();
		
		$Data['Data'] = $query->get();
		
		return response()->json($Data);
	 }
	
	public function DetailService($table, $id)
	{
		$Data = DB::table($table)->where('id', $id)->first();
		return response()->json($Data);
	}
	
	public function DetailServiceByField($table, $idfield, $id)
	{
		$Data = DB::table($table)->where($idfield, $id)->first();
		return response()->json($Data);
	}
	
	public function CreateService(Request $request,$table)
	{
		$Data = DB::table($table)->insert($request->all());
		return response()->json($Data);
	}
	
	public function DeleteService(Request $request,$table,$idfield)
	{
		$Data = DB::table($table)
                        ->where($idfield,$request->input($idfield))
                        ->delete();
		return response()->json($Data);
	}
	
	public function UpdateService(Request $request,$table,$idfield)
	{
		$Data = DB::table($table)
                        ->where($idfield,$request->get($idfield))
                        ->update($request->except("_method"));
		return response()->json($Data);
	}
	
}