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
})->middleware('girlbuyer');

Auth::routes();

Route::get('/account/settings/steps', 'AccountController@steps')->name('steps');
Route::post('/account/settings/steps', 'AccountController@stepsUpdate')->name('steps.update');

Route::get('/account/settings/gallery', 'AccountController@gallery')->name('gallery');
Route::post('/account/settings/gallery', 'AccountController@galleryUpdate')->name('gallery.update');

Route::get('/account/settings', 'AccountController@settings')->name('settings');
Route::post('/account/settings', 'AccountController@settingsUpdate')->name('settings.update');

Route::group(['middleware' => ['completed']], function() {
   Route::get('/home', 'HomeController@index')->name('home')->middleware('girlbuyer');
   Route::get('/girls', 'GirlController@index')->name('girls')->middleware('girlbuyer');
   Route::get('/girls/{category}', 'GirlController@category')->name('girls.category')
             ->middleware('girlbuyer');
   Route::get('/girls/{id}/description', 'GirlController@description')->name('girls.description')
             ->middleware('girlbuyer');
  Route::post('/girls/{id}/placebid', 'BidController@place')->name('girls.placebid')
             ->middleware('girlbuyer');
   Route::get('/account', 'AccountController@index')->name('account');

   Route::get('/account/{slug}','PageController@index')->name('info');

   Route::get('/messages', 'HomeController@index')->name('messages');
   Route::get('/bids', 'BidController@index')->name('bids');
   Route::get('/bids/{id}/accept', 'BidController@accept')->name('bids.accept');
   Route::get('/bids/{id}/pay', 'PaymentController@index')->name('bids.pay');
   Route::get('cancel', 'PaymentController@cancel')->name('payment.cancel');
   Route::get('payment/success', 'PaymentController@success')->name('payment.success');
});

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
    $exitCode = Artisan::call('storage:link', [] );
    echo $exitCode;
});

Route::get('/migration', function () {
    Artisan::call('migrate');
    $exitCode = Artisan::call('migrate', [] );
    echo $exitCode;
});

Route::get('{slug}', [
  'uses' => 'PageController@index'
])->where('slug', '([A-Za-z0-9\-\/]+)')->name('page');



