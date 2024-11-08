<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminsController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\ReservationsController;

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

// index page
Route::get('/', [Controller::class, 'index']);

// user login
Route::get('/login', [UsersController::class, 'login_page'])->middleware('guest');
Route::post('/login', [UsersController::class, 'login_handler'])->middleware('guest');

// user logout
Route::post('/logout', [UsersController::class, 'user_logout']);

// show admin page - future lts version
Route::get('/admin/profile/{username}', [AdminsController::class, 'show_admin']);

// show user page - future lts version
Route::get('/profile/{username}', [UsersController::class, 'show_profile_by_username']);

// register page
Route::get('/register', [UsersController::class, 'register_page'])->middleware('guest');
Route::get('/register/submit', [UsersController::class, 'redirect_to_register_page'])->middleware('guest');
Route::post('/register/submit', [UsersController::class, 'register_handler'])->middleware('guest');

// login page - admin
Route::get('/admin', [AdminsController::class, 'admin_login_page']);
Route::get('/admin/login', [AdminsController::class, 'redirect_to_login_page']);
Route::post('/admin/login', [AdminsController::class, 'admin_login']);
Route::post('/admin/logout', [AdminsController::class, 'admin_logout']);
Route::get('/admin/logout', [AdminsController::class, 'admin_logout']);

// find place page - user
Route::get('/places', [PlaceController::class, 'place_page']);
Route::post('/places', [PlaceController::class, 'search_place']);
Route::get('/places/place', [PlaceController::class, 'redirect_to_place']);

// find place and reservation page - version 2
Route::get('/places/place/{slug}', [PlaceController::class, 'select_place']);
Route::post('/places/reservation', [ReservationsController::class, 'place_reservation']);

// create place
Route::get('admin/places/create-place', [AdminsController::class, 'admin_create_place_page']);
Route::post('admin/places/post-place', [PlaceController::class, 'post_place']);

// delete place
Route::post('admin/places/delete', [PlaceController::class, 'delete_place']);

// edit place
Route::get('admin/places/edit', [AdminsController::class, 'admin_edit_place_page']);
Route::post('admin/places/edit', [AdminsController::class, 'admin_edit_place']);
Route::post('admin/places/update', [AdminsController::class, 'admin_edit_place_post']);

// admin place preview
Route::get('admin/places/{slug}', [PlaceController::class, 'preview_for_admin']);

// search place - fitur searching
Route::post('admin/places', [PlaceController::class, 'admin_search_place']);

// admin features
Route::get('admin/places', [AdminsController::class, 'place_page_by_admin']);
Route::get('admin/places/edit/{id}', [PlaceController::class, 'admin_place_edit']);
Route::get('admin/ticket', [AdminsController::class, 'ticket_check']);
Route::get('admin/ticket/find', [AdminsController::class, 'get_ticket_data']);
Route::post('admin/ticket/find', [AdminsController::class, 'post_ticket_data']);

// only debug purpose
Route::get('/check-token', [AdminsController::class, 'check']);

// user features
Route::get('/history', [UsersController::class, 'history_page']);
Route::post('/history/cancel', [UsersController::class, 'cancel_booking']);
Route::post('/history/change', [UsersController::class, 'change_booking']);
Route::post('/history/change/validate', [UsersController::class, 'update_booking_date']);
Route::get('/history/recommendation', [UsersController::class, 'get_recommendation']);

// next 
/*

> fitur searching

> admin menghapus tempat
> admin mengedit tempat
> admin mengatur pembatasan jumlah tiket yang dipesan

> user reservasi tempat || pilih tanggal
> user bisa melihat history pemesanan --> by user_id at reservations
> user bisa melihat status pemesanan --> asumsikan langsung berhasil

> user bisa melihat user lain
> user bisa mengedit profilnya sendiri

> admin bisa melihat admin lain
> admin bisa mengedit profilnya sendiri 

*/