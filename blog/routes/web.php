<?php

use Illuminate\Support\Facades\Route;

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

// Route :: get('/about-us', function(){
//     $about = "Hello";
//     // return view('pages.about', compact('about'));--> function
//     return view('pages.about', [
//         'ab' => $about
//     ]);
// });
Route::get('/about', 'TestController@about');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/category-list', 'CategoryController@CategoryList')->name('CategoryList');
Route::post('/category-post', 'CategoryController@CategoryPost')->name('CategoryPost');
Route::get('/category/delete/{id}', 'CategoryController@CategoryDelete')->name('CategoryDelete');

Route::get('/category-restore/{cat_id}','CategoryController@CategoryRestore')->name('CategoryRestore');
Route::get('/category-permanent-delete/{cat_id}','CategoryController@CategoryPermanentDelete')->name('CategoryPermanentDelete');

Route::get('/category/edit/{id}','CategoryController@CategoryEdit')->name('CategoryEdit');
Route::post('/category-update', 'CategoryController@CategoryUpdate')->name('CategoryUpdate');