<?php

use App\Controllers\AuthController;
use App\Controllers\CategoryController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Route;

Route::get(FOLDER_ADMIN . '', [HomeController::class, 'index']);

/* Rutas para blog */
Route::get(FOLDER_ADMIN . '/post', [PostController::class, 'index']);
Route::get(FOLDER_ADMIN . '/post/create', [PostController::class, 'create']);
Route::get(FOLDER_ADMIN . '/post/:slug/edit', [PostController::class, 'edit']);
Route::post(FOLDER_ADMIN . '/post/store', [PostController::class, 'store']);
Route::post(FOLDER_ADMIN . '/post/:slug/update', [PostController::class, 'update']);
Route::get(FOLDER_ADMIN . '/post/:slug/delete', [PostController::class, 'delete']);

//Rutas para Categories
Route::get(FOLDER_ADMIN . '/category', [CategoryController::class, 'index']);
Route::get(FOLDER_ADMIN . '/category/:slug/edit', [CategoryController::class, 'edit']);
Route::get(FOLDER_ADMIN . '/category/:slug/delete', [CategoryController::class, 'destroy']);
Route::post(FOLDER_ADMIN . '/category/store', [CategoryController::class, 'store']);
Route::post(FOLDER_ADMIN . '/category/update', [CategoryController::class, 'update']);

Route::get(FOLDER_ADMIN . '/:slug', [HomeController::class, 'index']);
Route::post(FOLDER_ADMIN . '/login', [AuthController::class, 'login']);
Route::post(FOLDER_ADMIN . '/logout', [AuthController::class, 'logout']);

Route::dispatch();