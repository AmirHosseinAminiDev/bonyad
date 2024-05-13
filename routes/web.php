`<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Documents\DocumentsController;
use App\Http\Controllers\Admin\MasterRequests\MasterRequestController;
use App\Http\Controllers\Admin\Teachers\TeacherController;
use App\Http\Controllers\Admin\Universities\UniversityController;
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
        Route::get('/create', [TeacherController::class, 'create'])->name('teachers.create');
        Route::post('/create', [TeacherController::class, 'store'])->name('teachers.store');
        Route::get('/edit/{teacher}', [TeacherController::class, 'edit'])->name('teachers.edit');
        Route::put('/edit/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');
        Route::put('/update-status/{teacher}', [TeacherController::class, 'status'])->name('teachers.status');
    });

    // UNIVERSITIES //
    Route::prefix('/universities')->group(function () {
        Route::get('/', [UniversityController::class, 'index'])->name('universities.index');
        Route::get('/create', [UniversityController::class, 'create'])->name('universities.create');
        Route::post('/create', [UniversityController::class, 'store'])->name('universities.store');
        Route::get('/edit/{university}', [UniversityController::class, 'edit'])->name('universities.edit');
        Route::put('/edit/{university}', [UniversityController::class, 'update'])->name('universities.update');
        Route::delete('/delete/{university}', [UniversityController::class, 'destroy'])->name('universities.destroy');
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
