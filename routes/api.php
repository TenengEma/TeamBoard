<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EmployeeController;
use App\Http\Controllers\Api\NoticeController;
use App\Http\Controllers\Api\DocumentController;
use App\Http\Controllers\Api\UserController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/me', [AuthController::class, 'me']);
    
    // Employees
    Route::apiResource('employees', EmployeeController::class);
    Route::get('employees/search/{query}', [EmployeeController::class, 'search']);
    
    // Notices
    Route::apiResource('notices', NoticeController::class);
    Route::get('notices/priority/{priority}', [NoticeController::class, 'byPriority']);
    Route::post('notices/{notice}/publish', [NoticeController::class, 'publish']);
    
    // Documents
    Route::apiResource('documents', DocumentController::class)->except(['update']);
    Route::get('documents/{document}/download', [DocumentController::class, 'download']);
    Route::post('documents/upload', [DocumentController::class, 'store']);
    
    // Users (admin only)
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('users', UserController::class);
        Route::post('users/{user}/assign-role', [UserController::class, 'assignRole']);
    });
});
