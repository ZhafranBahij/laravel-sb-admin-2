<?php

// use App\Livewire\Admin\Home;

use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\About;
use App\Livewire\Admin\Home;
use App\Livewire\Admin\Permission\PermissionCreate;
use App\Livewire\Admin\Permission\PermissionEdit;
use App\Livewire\Admin\Permission\PermissionIndex;
use App\Livewire\Admin\Role\RoleCreate;
use App\Livewire\Admin\Role\RoleIndex;
use App\Livewire\Admin\Role\RoleEdit;
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
    Route::get('profile', ProfileEdit::class)->name('profile.edit');
    // Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    // Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::middleware(['permission:view users'])->prefix('user')->group(function(){
        Route::get('', UserIndex::class)->name('user.index');
        Route::get('/create', UserCreate::class)->middleware('can:create users')->name('user.create');
        Route::get('/{user}/edit', UserEdit::class)->middleware('can:edit users')->name('user.edit');
    });

    Route::middleware(['permission:view roles'])->prefix('role')->group(function(){
        Route::get('', RoleIndex::class)->name('role.index');
        Route::get('/create', RoleCreate::class)->middleware('can:create roles')->name('role.create');
        Route::get('/{role}/edit', RoleEdit::class)->middleware('can:edit roles')->name('role.edit');
    });

    Route::middleware(['permission:view permissions'])->prefix('permission')->group(function(){
        Route::get('', PermissionIndex::class)->name('permission.index');
        Route::get('/create', PermissionCreate::class)->middleware('can:create permissions')->name('permission.create');
        Route::get('/{permission}/edit', PermissionEdit::class)->middleware('can:edit roles')->name('permission.edit');
    });

});
