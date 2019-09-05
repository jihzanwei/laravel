<?php
namespace App\Http\Controllers\kaoshi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Tools\Wechat;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use DB;
use phpDocumentor\Reflection\Location;;

/**
 * 
 */
class kaoshiController extends Controller
{
	public $wechat;
	
	public function __construct(Wechat $wechat)
	{
		$this->wechat = $wechat;

	}

	
	public 	function kaoshi_list()
	{

		return view('kaoshi.kaoshi_list');
	}
	public function do_kaoshi(Request $request)
	{
			 $req = $request->all();
			 // dd($req);
		 $info = DB::connection('access')->table('kaoshi')->insert([
		 	'one' => $req['one'],
		 	'two' => $req['two'],
		 	'three' => $req['three'],
		 	'four' => $req['four']

		 ]);
		 if($info){
		 	echo 1;
		 }else{
		 	echo 2;
		 }
	}
	


}