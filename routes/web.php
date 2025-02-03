<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeepSeekController;

Route::get('/chat', [DeepSeekController::class, 'chat']);
Route::post('/deepseek-query', [DeepSeekController::class, 'query'])->name('deepseek.query');