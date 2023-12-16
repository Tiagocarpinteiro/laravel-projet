<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', [AlbumController::class, 'index']);
Route::get("/albums", [ALbumController::class, 'albums']);
Route::get("/photos", [ALbumController::class, 'photos']);
Route::get("/album/{id}", [ALbumController::class, 'album'])->where("id", "[0-9]+");
Route::get("/album/{id}/edit", [ALbumController::class, 'edit_album'])->where("id", "[0-9]+");
Route::get("/addphoto/{id}", [ALbumController::class, 'addphoto'])->where("id", "[0-9]+");
Route::post("/addphotoT", [ALbumController::class, 'addphotoT']);
Route::get("/editalbum/{id}", [ALbumController::class, 'edit_album'])->where("id", "[0-9]+");
Route::get("/deletephoto/{album_id}/{photo_id}", [ALbumController::class, 'deletephoto'])->where("id", "[0-9]+");


Route::fallback(function() {
    return view('404');
});
