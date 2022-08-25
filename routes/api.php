<?php

use Illuminate\Http\Request;
use App\http\Controllers\productController;
use App\http\Controllers\CustomerCartsController;
use App\http\Controllers\userController;
use App\http\Controllers\CartController;
use App\http\Controllers\addedToCartController;

use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// this was executed immediately fetching data from the database table
Route::get('/data', [productController::class, 'getProducts']);

Route::get('/manage', [productController::class, 'manageProducts']);

Route::post('/addProduct', [productController::class, 'addProduct']);

// this handle the route rquest and send details to productcontroller class and perform the function delete 
Route::post('/delete', [productController::class, 'deleteProduct']);
Route::post('/edit', [productController::class, 'editProduct']);
Route::post('/update', [productController::class, 'updateProduct']);
Route::post('/relation', [productController::class, 'relation']);
// Added products to cart
Route::post('/cart', [CartController::class, 'index']);

Route::get('/cart', [addedToCartController::class, 'getCarts']);
Route::post('/addcart', [addedToCartController::class, 'addToCart']);
Route::post('/deletecart', [addedToCartController::class, 'deleteCart']);


// User registration // Controller
Route::post('/register', [userController::class, 'store']);
// Route::get('/login', [userController::class, 'getUsers']);
Route::post('/login', [userController::class, 'verifyUser']);
// Route::get('/login', [userController::class, 'verifyUser']);

