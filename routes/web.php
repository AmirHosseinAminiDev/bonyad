`<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Documents\DocumentsController;
use App\Http\Controllers\Admin\MasterRequests\MasterRequestController;
use App\Http\Controllers\Admin\Teachers\TeacherController;
use App\Http\Controllers\Admin\Users\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home.page');

Route::prefix('/admin-panel')->middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    //    USERS ROUTES //
    Route::prefix('/users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        Route::get('/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/create', [UserController::class, 'store'])->name('users.store');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/update/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/delete/{user}', [UserController::class, 'destroy'])->name('users.delete');
    });

    //    DOCS ROUTES //
    Route::prefix('/docs')->group(function () {
        Route::post('/create', [DocumentsController::class, 'store'])->name('docs.store');
    });

    //    REQUESTS ROUTES //
    Route::prefix('/master-requests')->group(function () {
        Route::get('/', [MasterRequestController::class, 'index'])->name('requests.index');
        Route::get('/{masterRequest}', [MasterRequestController::class, 'edit'])->name('requests.edit');
        Route::put('/{masterRequest}', [MasterRequestController::class, 'update'])->name('requests.update');
    });

    // TEACHERS ROUTES //
    Route::prefix('/teachers')->group(function () {
        Route::get('/', [TeacherController::class, 'index'])->name('teachers.index');
    });

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
