<?php

use Classes\Utility\Facades\Route\Route;

/* Home */
Route::add('/', [\Classes\Controllers\NewsController::class, 'index']);
Route::add('/article/{id}', [\Classes\Controllers\NewsController::class, 'single']);