<?php

use Classes\Facades\Route;

Route::add('/article/{id}', [\Classes\Controllers\NewsController::class, 'single']);
Route::add('/', [\Classes\Controllers\NewsController::class, 'index']);