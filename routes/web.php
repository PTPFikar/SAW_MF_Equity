<?php

use App\Http\Controllers\AdminCriteriaController;
use App\Http\Controllers\AdminProductsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardCalculationController;
use App\Http\Controllers\DashboardProfileController;
use App\Http\Controllers\DashboardUploadProductsController;
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

Route::middleware('guest')->group(function () {
  Route::get('/', [AuthController::class, 'index'])->name('login');
  Route::post('/', [AuthController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {
  Route::post('/signout', [AuthController::class, 'signOut']);

  Route::get('/dashboard', function () {
    return view('dashboard.index', [
      'title' => 'Dashboard'
    ]);
  });

  Route::get('dashboard/profile', [DashboardProfileController::class, 'index']);
  Route::put('dashboard/profile/{user}', [DashboardProfileController::class, 'update']);

  Route::get('dashboard/calculation', [DashboardCalculationController::class, 'index']);
  Route::post('dashboard/calculation', [DashboardCalculationController::class, 'store']);

  Route::get('dashboard/upload-products', [DashboardUploadProductsController::class,'index']);
  Route::post('dashboard/upload-products', [DashboardUploadProductsController::class,'upload_csv_file'])->name('upload_csv');
 
  Route::get('dashboard/products', [AdminProductsController::class, 'index']);
  Route::get('dashboard/products/edit/{id}', [AdminProductsController::class, 'edit']);
  Route::post('dashboard/products/update/{id}', [AdminProductsController::class, 'update']);
  Route::get('dashboard/products/delete/{id}', [AdminProductsController::class, 'delete']);

  Route::resources([
    'dashboard/criterias'     => AdminCriteriaController::class
  ], ['except' => 'show']);
});
