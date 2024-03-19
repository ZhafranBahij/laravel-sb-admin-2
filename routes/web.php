<?php

// use App\Livewire\Admin\Home;

use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\About;
use App\Livewire\Admin\Home;
use App\Livewire\Admin\User\UserCreate;
use App\Livewire\Admin\User\UserEdit;
use App\Livewire\Admin\User\UserIndex;
use App\Livewire\Cms\ProfileEdit;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::middleware('auth')->group(function(){
    Route::get('home', Home::class)->name('home');
    Route::get('about', About::class)->name('about');
    // Route::get('profile', ProfileEdit::class)->name('profile.edit');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::prefix('user')->group(function(){
        Route::get('', UserIndex::class)->name('user.index');
        Route::get('/create', UserCreate::class)->name('user.create');
        Route::get('/{user}/edit', UserEdit::class)->name('user.edit');
    });

});


// Route::get('/about', function () {
//     return view('about');
// })->name('about');
