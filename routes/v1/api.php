<?php
use Illuminate\Support\Facades\Route;

Route::controller(GroupController::class)->group(function () {
    Route::get('/groups', 'index');
    Route::get('/groups/{id}', 'show');
    Route::get('/groups/{id}/results', 'getResults');
    Route::post('/groups/{id}/results', 'postResults');
});
Route::resource('games', GameController::class);