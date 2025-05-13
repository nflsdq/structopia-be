<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\MateriController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\BadgeController;
use App\Http\Controllers\LeaderboardController;

// Auth Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    // Auth
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);

    // Levels
    Route::get('/levels', [LevelController::class, 'index']);
    Route::get('/levels/{id}', [LevelController::class, 'show']);
    Route::get('/levels/{id}/materi', [LevelController::class, 'getMateri']);

    // Admin only routes
    // Route::middleware('role:admin')->group(function () {
    //     Route::post('/levels', [LevelController::class, 'store']);
    //     Route::put('/levels/{id}', [LevelController::class, 'update']);
    //     Route::delete('/levels/{id}', [LevelController::class, 'destroy']);

    //     Route::post('/materi', [MateriController::class, 'store']);
    //     Route::put('/materi/{id}', [MateriController::class, 'update']);
    //     Route::delete('/materi/{id}', [MateriController::class, 'destroy']);
    // });

    Route::post('/levels', [LevelController::class, 'store']);
    Route::put('/levels/{id}', [LevelController::class, 'update']);
    Route::delete('/levels/{id}', [LevelController::class, 'destroy']);
    Route::post('/materi', [MateriController::class, 'store']);
    Route::put('/materi/{id}', [MateriController::class, 'update']);
    Route::delete('/materi/{id}', [MateriController::class, 'destroy']);

    // Materi
    Route::get('/materi/{id}', [MateriController::class, 'show']);

    // Quiz
    Route::get('/levels/{id}/quiz', [QuizController::class, 'getLevelQuiz']);
    Route::post('/quiz/submit', [QuizController::class, 'submit']);
    Route::get('/quiz/history', [QuizController::class, 'history']);

    // Progress
    Route::get('/progress', [ProgressController::class, 'index']);
    Route::post('/progress/update', [ProgressController::class, 'update']);
    Route::get('/progress/unlocked-levels', [ProgressController::class, 'getUnlockedLevels']);

    // Badges
    Route::get('/badges', [BadgeController::class, 'index']);
    Route::get('/user/badges', [BadgeController::class, 'getUserBadges']);
    Route::post('/user/badges/assign', [BadgeController::class, 'assignBadge']);

    // Leaderboard
    Route::get('/leaderboard', [LeaderboardController::class, 'index']);
});