<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
//all listings
Route::get('/', [ListingController::class,'index']);
 
//show create form
Route::get('/listing/create',[ListingController::class,'create'])->middleware('auth'); 

//store listing data
Route::post('/listing',[ListingController::class,'store'])->middleware('auth');

//show Edit Form
Route::get('/listing/{listing}/edit',
[listingController::class,'edit'])->middleware('auth');

//Update listing
Route::put('/listing/{listing}',
[listingController::class,'update'])->middleware('auth');

//Delete listing
Route::delete('/listing/{listing}',
[listingController::class,'destroy'])->middleware('auth');

//manage Listing
Route::get('/listing/manage',[ListingController::class,'manage'])->middleware('auth');

//single listing
Route::get('/listing/{listing}',[ListingController::class,'show']);

//show Register/create form
Route::get('/register',[UserController::class,'create'])->middleware('guest');

//create New user
Route::post('/users',[UserController::class,'store']);

//log User out
Route::post('/logout',[UserController::class,'logout'])->middleware('auth');

//show login form
Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');

//Log In User
Route::post('/users/authenticate',[UserController::class,'authenticate'])->middleware('guest');

