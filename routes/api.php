<?php

use Illuminate\Http\Request;
use App\http\Controllers\productController;
use App\http\Controllers\CustomerCartsController;
use App\http\Controllers\userController;

use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// this was executed immediately fetching data from the database table
Route::get('/data', [productController::class, 'getProducts']);

Route::post('/addProduct', [productController::class, 'addProduct']);

// this handle the route rquest and send details to productcontroller class and perform the function delete 
Route::post('/delete', [productController::class, 'deleteProduct']);
Route::post('/edit', [productController::class, 'editProduct']);
Route::post('/update', [productController::class, 'updateProduct']);
Route::post('/relation', [productController::class, 'relation']);


// User registration // Controller
Route::post('/store', [userController::class, 'store']);
Route::get('/store', [userController::class, 'getUsers']);

