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
		'client_id' => '3',
		'redirect_uri' => 'http://manager.test/oauth/callback',
		'response_type' => 'code',
		'scope' => '',
	]);

	return redirect('http://manager.test/oauth/authorize?' . $query);
});


Route::get('/oauth/callback', function() {

	$http = new GuzzleHttp\Client;

	if(request('code')) {
		$response = $http->post('http://manager.test/oauth/token', [
			'form_params' => [
				'grant_type' => 'authorization_code',
				'client_id' => '3',
				'client_secret' => 'D9hNwHUBe9oegZeFoAOeTMeLlq9dbdmtTlF31yfj',
				'redirect_uri' => 'http://manager.test/oauth/callback',
				'code' => request('code'),
			],
		]);

		return json_decode((string)$response->getBody(), TRUE);
	} else {
		return response()->json(['error' => request('error')]);
	}
});
