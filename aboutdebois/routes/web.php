<?php
use App\Models\Image;
use App\Mail\AbdbEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\CategoryController;

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
    $images = Image::all();
    return view('Front.page.static', compact('images'));
})->name('static');
Route::post('/', function (Request $request) {
    //dd($request);
    Mail::to('ben09.dev.test@gmail.com')->send(new AbdbEmail($request));
    return redirect('/')->with('ok', __('Votre message à bien été envoyé, nous vous répondrons le plus rapidement possible :)'));
});

//Auth::routes();
$admin = "/abdb-admin";
// Authentication Routes...
Route::get($admin . '/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post($admin . '/login', 'Auth\LoginController@login');
Route::post($admin . '/logout', 'Auth\LoginController@logout')->name('logout');
Route::post($admin . '/register', 'Auth\RegisterController@register');
Route::get($admin . '/register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post($admin . '/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post($admin . '/password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');
Route::get($admin . '/password/reset', 'Auth\forgotPasswordController@showLinkRequestForm')->name('password.request');
Route::get($admin . '/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::get($admin . '/home', 'HomeController@index')->name('home');

//Category
Route::get($admin . '/categorie/create', 'CategoryController@create')->name('category.create');
Route::post($admin . '/categorie/store', 'CategoryController@store')->name('category.store');
Route::get($admin . '/categories', 'CategoryController@index')->name('category.index');
Route::get($admin . '/categorie/edit/{category}', 'CategoryController@edit')->name('category.edit');
Route::put($admin . '/categorie/update/{category}', 'CategoryController@update')->name('category.update');
Route::delete($admin . '/categorie/destroy/{category}', 'CategoryController@destroy')->name('category.destroy');
//Images
Route::get($admin . '/galerie/create', 'GaleryController@create')->name('galery.create');
Route::post($admin . '/galerie/store', 'GaleryController@store')->name('galery.store');
Route::get($admin . '/galerie/categorie/{slug}', 'GaleryController@category')->name('galery.category');
Route::delete($admin . '/galerie/destroy/{image}', 'GaleryController@destroy')->name('galery.destroy');
Route::get($admin . '/galerie/edit/{image}', 'GaleryController@edit')->name('galery.edit');
Route::put($admin . '/galerie/update/{image}', 'GaleryController@update')->name('galery.update');
Route::get($admin . '/galerie/{image}', 'GaleryController@get')->name('galery.get');