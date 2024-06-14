<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



use App\Http\Controllers\AdminController;



Route::prefix('admin')->group(function () {
    Route::post('register', [AdminController::class, 'register']);
    Route::post('login', [AdminController::class, 'login']);
    Route::post('logout', [AdminController::class, 'logout']);
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', [AdminController::class, 'dashboard']);
        Route::post('teacher', [AdminController::class, 'addTeacher']);
        Route::put('teacher/{id}', [AdminController::class, 'editTeacher']);
        Route::delete('teacher/{id}', [AdminController::class, 'deleteTeacher']);
        Route::get('teachers', [AdminController::class, 'listTeachers']);
        Route::post('schedule', [AdminController::class, 'addSchedule']);
    });
});

});
