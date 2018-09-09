<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Maind admin page controller
 * Class MainController
 * @package App\Http\Controllers\Admin
 */
class MainController extends Controller
{

	
	/**
	 * Return main admin page
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function index(){
	    return view('admin.home');
    }
}
