<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/redirect', function() {
	$query = http_build_query([
		'client_id' => '5',
		'redirect_uri' => 'http://osmanager.dev/oauth/callback',
		'response_type' => 'code',
		'scope' => '',
	]);

	return redirect('http://osmanager.dev/oauth/authorize?' . $query);
});


Route::get('/oauth/callback', function() {

	$http = new GuzzleHttp\Client;

	if(request('code')) {
		$response = $http->post('http://osmanager.dev/oauth/token', [
			'form_params' => [
				'grant_type' => 'authorization_code',
				'client_id' => '5',
				'client_secret' => 'wNF9rR9crcsBHGbe31MKF691mFcHk4ra9bsp8AKE',
				'redirect_uri' => 'http://osmanager.dev/oauth/callback',
				'code' => request('code'),
			],
		]);

		return json_decode((string)$response->getBody(), TRUE);
	} else {
		return response()->json(['error' => request('error')]);
	}
});
