<?php

use Illuminate\Support\Facades\Route;


// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//............................ Category Route ........................

//Route for category
Route::post('/categoryStore', 'CategoryController@store')->name('category.store');

//Route getCategoryList //  Step: 6
Route::get('/CategoryList', 'CategoryController@index')->name('category.index');

//Route getCategoryEdit
Route::get('/categoryById/{id}', 'CategoryController@edit')->name('category.edit');

//Route categoryUpdate
Route::post('/categoryUpdate/{id}', 'CategoryController@update')->name('category.update');

//Route categoryUpdate
Route::get('/categoryDelete/{id}', 'CategoryController@destroy')->name('category.delete');

//............................Sub Category Route ........................

//Route for category
Route::post('/SubCategoryStore', 'SubCategoryController@store')->name('SubCategory.store');

//Route getCategoryList //  Step: 6
Route::get('/SubCategoryList', 'SubCategoryController@index')->name('SubCategory.index');

//Route getCategoryEdit
Route::get('/SubCategoryById/{id}', 'SubCategoryController@edit')->name('SubCategory.edit');

//Route categoryUpdate
Route::post('/SubCategoryUpdate/{id}', 'SubCategoryController@update')->name('SubCategory.update');

//Route categoryUpdate
Route::get('/SubCategoryDelete/{id}', 'SubCategoryController@destroy')->name('SubCategory.delete');


//............................Product Route ........................

Route::get('/getSubcategoryByCategoryId/{id}', 'ProductController@getSubcategoryByCategoryId')->name('product.getSubcategoryByCategoryId');

//Route for category
Route::post('/productStore', 'ProductController@store')->name('product.store');

//Route getCategoryList //  Step: 6
Route::get('/productList', 'ProductController@index')->name('product.index');

//Route getCategoryEdit
Route::get('/productById/{id}', 'ProductController@edit')->name('product.edit');

//Route categoryUpdate
Route::post('/productUpdate/{id}', 'ProductController@update')->name('product.update');

//Route categoryUpdate
Route::get('/productDelete/{id}', 'ProductController@destroy')->name('product.delete');


