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


/*Route::get('/', function () {
    return view('welcome');
});*/
Route::group(['prefix' => '{locale}',
'where' => ['locale' => '[a-zA-Z]{2}'],
'middleware' => 'setlocale'],
function() {
    Route::get('/', function () {
        return view('home');
    });
    Route::get('/language/{locale}', function ($lang) {
        $languages = ['ru', 'en'];
        if (in_array($lang, $languages)) {
            App::setLocale($lang);
            Session::put('locale', $lang);
        }
        return redirect()->back();
    });
    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
});

Route::get('/', function () {
    return redirect(app()->getLocale());
});
