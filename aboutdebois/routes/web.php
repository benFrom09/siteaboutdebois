<?php
use App\Models\Image;
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

Auth::routes();
$admin = "/abdb-admin";
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