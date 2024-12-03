<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;



Route::get('/', [UserController::class, "viewcorrectHomepage"]);



//Routes for User

Route::post('/register', [UserController::class, "register"]);

Route::post('/login', [UserController::class, "login"]);

Route::post('/logout', [UserController::class, "logout"]);


//Routes for Blog Posts

Route::get('/create_post', [PostController::class, 'createPostForm']);

Route::post('/create_post', [PostController::class, 'createPost']);

