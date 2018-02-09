<?php
/**
 * Created by PhpStorm.
 * User: yordangeorgiev
 * Date: 9.02.18
 * Time: 7:12
 */
namespace App\Http\Controllers\Tasks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Icecat extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
//		$this->middleware('auth');
	}

	public function demo() {
		return response()->json([
			'name' => 'Abigail',
			'state' => 'CA'
		]);
	}


}