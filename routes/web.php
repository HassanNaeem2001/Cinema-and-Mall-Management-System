<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Employee;
use App\Http\Controllers\AdminController;
Route::get('/', function () {
    return view('users.index');
});
Route::get('/adm', function () {
    return view('admin.dashboard');
});

//User Middleware
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
       if(Auth::user()->role == "Admin")
       {
          return view('admin.dashboard');
       }
       else if(Auth::user()->role == "Employee")
       {
        return response()->json("Employee Dashboard is Under Maintenance");
       }
       else
       {
        return redirect('/');
       }
    })->name('dashboard');
});
//Admin Middleware
Route::middleware([Admin::class])->group(function(){

Route::get('/allusers', [AdminController::class,('getallusers')]);
Route::get('/trashusers', [AdminController::class,('removedusers')]);
Route::post('/removeuser/{id}',[AdminController::class,('removeuser')]);
Route::post('/trashuser/{id}',[AdminController::class,('trashuser')]);
Route::get('/adduser',function(){
    return view('admin.adduser');
});
Route::post('/insertuser',[AdminController::class,('addnewuser')]);
});