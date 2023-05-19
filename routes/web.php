<?php

use App\Controllers\AuthController;
use App\Controllers\CategoryController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Route;

Route::get('/admin', [HomeController::class, 'index']);

/* Rutas para blog */
Route::get('/admin/post', [PostController::class, 'index']);
Route::get('/admin/post/create', [PostController::class, 'create']);
Route::get('/admin/post/:slug/edit', [PostController::class, 'edit']);
Route::post('/admin/post/store', [PostController::class, 'store']);
Route::post('/admin/post/:slug/update', [PostController::class, 'update']);
Route::get('/admin/post/:slug/delete', [PostController::class, 'delete']);

//Rutas para Categories
Route::get('/admin/category', [CategoryController::class, 'index']);
Route::get('/admin/category/:slug/edit', [CategoryController::class, 'edit']);
Route::get('/admin/category/:slug/delete', [CategoryController::class, 'destroy']);
Route::post('/admin/category/store', [CategoryController::class, 'store']);
Route::post('/admin/category/update', [CategoryController::class, 'update']);

Route::get('/admin/:slug', [HomeController::class, 'index']);
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout']);

Route::dispatch();