<?php

use App\Http\Livewire\Home;
use App\Http\Livewire\RoomPage;
use App\Models\Room;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', Home::class)->name('home');
Route::get('room', RoomPage::class)->name('room');
Route::get('room/{room}', function (Room $room) {
    return view('room-join', compact('room'));
})->name('room.join');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
