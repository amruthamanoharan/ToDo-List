<?php
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\TaskManager;
use Illuminate\Support\Facades\Route;


Route::get('login', [AuthManager::class, 'login'])->name(name:"login");
Route::post('login', [AuthManager::class, 'loginPost'])->name(name:"login.post");

Route::get('register', [AuthManager::class, 'register'])->name(name:"register");
Route::post('register', [AuthManager::class, 'registerPost'])->name(name:"register.post");

Route::get('logout', [AuthManager::class, 'logout'])->name(name:"logout");

Route::middleware("auth")->group(function(){
    Route::get('/', [TaskManager::class, "listTask"])->name(name:"home");

    Route::get("task/add", [TaskManager::class, "addTask"])->name(name:"task.add");

    Route::post("task/add", [TaskManager::class, "addTaskPost"])->name(name:"task.add.post");

    Route::get("task/status/{id}", [TaskManager::class, "updateTaskStatus"])->name(name:"task.status.update");
    Route::get("task/delete/{id}", [TaskManager::class, "deteleTask"])->name(name:"task.delete");

});