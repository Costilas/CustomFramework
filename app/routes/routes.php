<?php

use Classes\Utility\Facades\Route\Route;

Route::add('/article/{id}', [\Classes\Controllers\NewsController::class, 'single']);
Route::add('/users', [\Classes\Controllers\StaffController::class, 'index']);
Route::add('/user', [\Classes\Controllers\StaffController::class, 'single']);

/* Ajax (json) */
Route::add('/getUserJson', [\Classes\Controllers\JSONController::class, 'getSingleUserJson']);

/* Home */
Route::add('/', [\Classes\Controllers\NewsController::class, 'index']);