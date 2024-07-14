<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Task\TaskController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix("v1")->group(function () {

    Route::get("/", function () {
        return [
            "status" => 200,
            "message" => "Laravel Todo Api"
        ];
    });

    Route::prefix("auth")->controller(AuthController::class)->group(function () {
        Route::post("login", "login");
    });


    Route::middleware("auth:sanctum")->group(function () {
        Route::post("logout", [AuthController::class, "logout"]);

        Route::prefix("users")->controller(UserController::class)->group(function () {
            Route::get("/", "getAll");
            Route::get("/minimal", "getAllMinimal");
            Route::get("{id?}/tasks", "getAllUserTasks");
            Route::post("create", "create");
        });

        Route::prefix("tasks")->controller(TaskController::class)->group(function () {
            Route::get("/", "get");
            Route::post("create", "create");
            Route::delete("delete/{task?}", "delete");
            Route::put("update/{task?}", "update");
        });
    });
});
