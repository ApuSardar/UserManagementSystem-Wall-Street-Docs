<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Models\User;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';







Route::get('admin/login',  [AdminController::class, 'adminLogin'])->name('admin.login');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('admin.logout',  [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('admin/profile',  [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::get('admin/edit-profile',  [AdminController::class, 'adminEditProfile'])->name('edit.profile');
    Route::post('admin/store-profile',  [AdminController::class, 'adminStoreProfile'])->name('store.profile');
    Route::get('admin/profile/delete',  [AdminController::class, 'adminDeleteProfile'])->name('delete.profile');


    // Display a listing of users
    Route::get('admin/users', [AdminController::class, 'index'])->name('users.index');
    Route::get('admin/users/create', [AdminController::class, 'create'])->name('users.create');
    Route::post('admin/users', [AdminController::class, 'store'])->name('users.store');
    Route::get('admin/users/{id}/edit', [AdminController::class, 'edit'])->name('users.edit');
    Route::put('admin/users/{id}', [AdminController::class, 'update'])->name('users.update');
    Route::delete('admin/users/{id}', [AdminController::class, 'destroy'])->name('users.destroy');
    Route::post('admin/users/updateStatus/{id}', [AdminController::class, 'updateStatus'])->name('users.updateStatus');
}); // End Group Admin middleware





Route::get('user/login',  [UserController::class, 'userLogin'])->name('user.login');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'userDashboard'])->name('user.dashboard');
    Route::get('user.logout',  [UserController::class, 'userLogout'])->name('user.logout');
    Route::get('user/profile',  [UserController::class, 'userProfile'])->name('user.profile');
    Route::get('user/edit-profile',  [UserController::class, 'userEditProfile'])->name('user.edit.profile');
    Route::post('user/store-profile',  [UserController::class, 'userStoreProfile'])->name('user.store.profile');
    Route::get('user/profile/delete',  [UserController::class, 'userDeleteProfile'])->name('user.delete.profile');
}); // End Group User middleware
