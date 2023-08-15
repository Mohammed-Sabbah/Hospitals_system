<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionsController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::prefix('admin')->middleware('auth:admin')->group(function () {

    Route::middleware('can:index-hospitals')->resource('hospital', HospitalController::class);
    Route::resource('majors', MajorController::class);
    Route::resource('doctors', DoctorController::class);
    Route::resource('admins', AdminController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    Route::resource('permissions/role', RolePermissionsController::class);

    Route::get('logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('change-password', [AuthController::class, 'changePassword'])->name('admin.changePassword');
    Route::post('change-password', [AuthController::class, 'postChangePassword'])->name('admin.postChangePassword');
    Route::get('dashboard', function () {
        return view('admin.home');
    })->name('admin.home');
});

Route::prefix('admin')->middleware('guest:admin')->group(function () {

    Route::get('login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('login', [AuthController::class, 'submitLogin'])->name('admin.submitLogin');
});





// ////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                                // Frontend Routes
// ////////////////////////////////////////////////////////////////////////////////////////////////////////////


Route::get('/' , [FrontEndController::class , 'home'])->name('front.home');
