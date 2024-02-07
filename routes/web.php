<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ManageEmployeeController;
use App\Http\Controllers\TeamLeader\TeamLeaderController;
use App\Http\Controllers\Admin\ManageTeamLeaderController;
use App\Http\Controllers\TeamLeader\ManageProjectController;
use App\Http\Controllers\TeamLeader\ManageEmployesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can store web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
      Route::get('logout', [HomeController::class,'logout'])->name('logout');

// Employee route list

Route::middleware(['auth', 'user-access:employee'])->group(function () {
  
    Route::get('/employee', [HomeController::class, 'index'])->name('employee.home');
});

// End Employee route list
  
// Admin route list
Route::middleware(['auth', 'user-access:owner'])->group(function () {
  
    Route::get('/owner', [AdminController::class, 'Owner'])->name('owner.home');
    
    // manage employee
        Route::get('/owner/manage/employee', [ManageEmployeeController::class, 'index'])->name('owner.manage.employee');
        Route::get('/owner/employee/create', [ManageEmployeeController::class, 'create'])->name('owner.create.employee');
        Route::post('/owner/employee/store', [ManageEmployeeController::class, 'store'])->name('owner.store.employee');
        Route::get('/owner/employee/edit/{user}', [ManageEmployeeController::class, 'edit'])->name('owner.edit.employee');
        Route::post('/owner/employee/update/{user}', [ManageEmployeeController::class, 'update'])->name('owner.update.employee');
        Route::delete('/owner/employee/delete/{user}', [ManageEmployeeController::class, 'destroy'])->name('owner.destroy.employee');

    // 

    // manage team leader
        Route::get('/owner/manage/team-leader', [ManageTeamLeaderController::class, 'index'])->name('owner.manage.team-leader');
        Route::get('/owner/team-leader/create', [ManageTeamLeaderController::class, 'create'])->name('owner.create.team-leader');
        Route::post('/owner/team-leader/store', [ManageTeamLeaderController::class, 'store'])->name('owner.store.team-leader');
        Route::get('/owner/team-leader/edit/{user}', [ManageTeamLeaderController::class, 'edit'])->name('owner.edit.team-leader');
        Route::post('/owner/team-leader/update/{user}', [ManageTeamLeaderController::class, 'update'])->name('owner.update.team-leader');
        Route::delete('/owner/team-leader/delete/{user}', [ManageTeamLeaderController::class, 'destroy'])->name('owner.destroy.team-leader');
    //
});

// End Admin route list

// team-leader route list

Route::middleware(['auth', 'user-access:team-leader'])->group(function () {
  
    Route::get('/team-leader', [TeamLeaderController::class, 'TemaLeader'])->name('team-leader.home');
    
    // manage employee
    Route::get('/team-leader/manage/employee', [ManageEmployesController::class, 'index'])->name('team-leader.manage.employee');
    Route::get('/team-leader/employee/create', [ManageEmployesController::class, 'create'])->name('team-leader.create.employee');
    Route::post('/team-leader/employee/store', [ManageEmployesController::class, 'store'])->name('team-leader.store.employee');
    Route::get('/team-leader/employee/edit/{user}', [ManageEmployesController::class, 'edit'])->name('team-leader.edit.employee');
    Route::post('/team-leader/employee/update/{user}', [ManageEmployesController::class, 'update'])->name('team-leader.update.employee');
    Route::delete('/team-leader/employee/delete/{user}', [ManageEmployesController::class, 'destroy'])->name('team-leader.destroy.employee');
    
    // 
    
    // manage project
    Route::get('/team-leader/manage/project', [ManageProjectController::class, 'index'])->name('team-leader.manage.project');
    Route::get('/team-leader/project/create', [ManageProjectController::class, 'create'])->name('team-leader.create.project');
    Route::post('/team-leader/project/store', [ManageProjectController::class, 'store'])->name('team-leader.store.project');
    Route::get('/team-leader/project/edit/{project}', [ManageProjectController::class, 'edit'])->name('team-leader.edit.project');
    Route::post('/team-leader/project/update/{project}', [ManageProjectController::class, 'update'])->name('team-leader.update.project');
    Route::delete('/team-leader/project/delete/{project}', [ManageProjectController::class, 'destroy'])->name('team-leader.destroy.project');
    //







});

// End team-leader route list
