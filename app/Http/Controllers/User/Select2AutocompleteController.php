<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class Select2AutocompleteController extends Controller
{
	/**
	 * Show the application layout.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function layout()
	{
		return view('select2');
	}
	
	
	/**
	 * Show the application dataAjax.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function dataAjax(Request $request)
	{
		$data = [];
		
		
		if($request->has('q')){
			$search = $request->q;
			
			$data = DB::table("tags")
				->select("id","name","slug")
				->where('name','LIKE',"%$search%")
				->get();
	
			
		}
		
		
		return response()->json($data);
	}
}
