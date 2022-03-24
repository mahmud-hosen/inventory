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
Route::get('/getProductBySubCategoryId/{id}', 'ProductController@getProductBySubCategoryId')->name('product.getProductBySubCategoryId');
Route::get('/getProductBySearch/{value}', 'ProductController@getProductBySearch')->name('product.getProductBySearch');
Route::get('/subcategoryWiseProduct', 'ProductController@subcategoryWiseProduct')->name('product.subcategoryWiseProduct');



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

//............................Cart Route ........................
Route::get('/productAddToCart/{id}', 'CartController@productAddToCart')->name('cart.productAddToCart');
Route::get('/clearCart', 'CartController@clearCart')->name('cart.clearCart');
Route::get('/removeItemFromCart/{id}', 'CartController@removeItemFromCart')->name('cart.removeItemFromCart');
Route::post('/updateCart', 'CartController@updateCart')->name('cart.updateCart');
Route::get('/createInvoice/{id}', 'CartController@createInvoice')->name('cart.createInvoice');

//............................Document Route ..............................................
Route::post('/GeneratePDF', 'DocumentController@GeneratePDF')->name('Document.GeneratePDF');



//............................Customer Route ........................

Route::post('/customerStore', 'CustomerController@store')->name('customer.store');
Route::get('/customerList', 'CustomerController@index')->name('customer.index');
Route::get('/customerById/{id}', 'CustomerController@edit')->name('customer.edit');
Route::post('/customerUpdate/{id}', 'CustomerController@update')->name('customer.update');
Route::get('/customerDelete/{id}', 'CustomerController@destroy')->name('customer.delete');

//............................Order Route ........................
Route::post('/confirm_order', 'OrderController@confirm_order')->name('order.confirm_order');
Route::get('/orderList', 'OrderController@orderList')->name('order.orderList');
Route::get('/orderDetails/{id}', 'OrderController@orderDetails')->name('order.orderDetails');
Route::get('/aprove_order/{id}', 'OrderController@aprove_order')->name('order.aprove_order');
Route::get('/pending_order/{id}', 'OrderController@pending_order')->name('order.pending_order');
Route::get('/delete_Order/{id}', 'OrderController@delete_Order')->name('order.delete_Order');

//............................Customer Route ........................
Route::post('/employeeStore', 'EmployeeController@store')->name('employee.store');
Route::get('/employeeList', 'EmployeeController@index')->name('employee.index');
Route::get('/employeeById/{id}', 'EmployeeController@edit')->name('employee.edit');
Route::post('/employeeUpdate/{id}', 'EmployeeController@update')->name('employee.update');
Route::get('/employeeDelete/{id}', 'EmployeeController@destroy')->name('employee.delete');


//............................Salary Route ........................
Route::post('/employeeSalaryStore', 'SalaryController@store')->name('salary.store');
 Route::get('/salaryList', 'SalaryController@index')->name('salary.index');
Route::get('/salaryById/{id}', 'SalaryController@edit')->name('salary.edit');
Route::post('/salaryUpdate/{id}', 'SalaryController@update')->name('salary.update');
Route::get('/salaryDelete/{id}', 'SalaryController@destroy')->name('salary.delete');
Route::get('/getSalaryBySearch/{value}', 'SalaryController@getSalaryBySearch')->name('salary.getSalaryBySearch');


//............................Salary Route ........................
Route::post('/attendenceStore', 'AttendenceController@store')->name('attendence.store');
Route::get('/todayAttendenceList', 'AttendenceController@index')->name('attendence.index');
Route::get('/attendenceById/{id}', 'AttendenceController@edit')->name('attendence.edit');
Route::post('/attendenceUpdate/{id}', 'AttendenceController@update')->name('attendence.update');
Route::get('/getAttendenceBySearch/{value}', 'AttendenceController@getAttendenceBySearch')->name('attendence.getAttendenceBySearch');

//............................Stock Route ........................
Route::post('/stockStore', 'StockController@store')->name('stock.store');
Route::get('/getStoreProduct/{id}', 'StockController@index')->name('stock.index');
Route::get('/StockEdit/{id}', 'StockController@edit')->name('stock.edit');
Route::post('/stockUpdate/{id}', 'StockController@update')->name('stock.update');
Route::get('/stocktDelete/{id}', 'StockController@destroy')->name('stock.delete');















