<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PersonController extends Controller{
    
        
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
            $Person['Total'] = $query->count();
            
            
            $Person['Data'] = $query->get();
            
            return response()->json($Person);
	 }
	
	public function DetailService($id)
	{
		$Person = Person::find($id);
		
		return response()->json($Person);
	}
	
	public function CreateService(Request $request,$table)
	{
		$Person = DB::table($table)->insert($request->all());
		
		return response()->json($Person);
	}
	
	public function DeleteService(Request $request,$table)
	{
		
		$Person = DB::table($table)
                        ->where('id',$request->get('id'))
                        ->delete();
		return response()->json('success');
	}
	
	public function UpdateService(Request $request,$table)
	{
		$Person = DB::table($table)
                        ->where('id',$request->get('id'))
                        ->update($request->all());
		return response()->json($Person);
	}
	
}