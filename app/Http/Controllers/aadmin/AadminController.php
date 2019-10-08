<?php

namespace App\Http\Controllers\aadmin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
class AadminController extends Controller
{
	public function login(){

		return view('aadmin.login');
	}
	public function index(){

		return view('aadmin.index');
	}
	public function insert()
	{
		return view('aadmin.insert');
	
	}
  
}
