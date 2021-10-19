<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdditivesController;
use App\Http\Controllers\AdditiveStoresController;
use App\Http\Controllers\MilkController;
use App\Http\Controllers\productionOrdersController;
use App\Http\Controllers\ProvidersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProductStoresController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

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

Route::get('/login', [SessionsController::class, 'create']) -> name('login');
Route::post('/store', [SessionsController::class, 'store']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return 'Hello World';
    });
    Route::get('productionOrders/calculate', [ProductionOrdersController::class, 'calculate']);
    Route::get('productionOrders/calculateUpdate/{productionOrder}', [productionOrdersController::class, 'calculateUpdate']) -> name('calculateUpdate');
    Route::get('/', [productStoresController::class, 'search']);
    Route::resource('additives', AdditivesController::class)->except(['show']);
    Route::resource('providers', ProvidersController::class)->except(['show']);
    Route::resource('products', ProductsController::class);
    Route::resource('productStores', ProductStoresController::class);
    Route::resource('additiveStores', AdditiveStoresController::class)->except(['show']);
    Route::resource('milkStore', MilkController::class)->only(['index', 'edit', 'update']);
    Route::resource('productionOrders', ProductionOrdersController::class)->except(['show']);
    Route::post('/destroy', [SessionsController::class, 'destroy']);
    Route::resource('users', UsersController::class);

});

