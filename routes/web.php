<?php

use App\Http\Controllers\ChatbotController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ChatbotController::class, 'index']);
Route::post('/chatbot', [ChatbotController::class, 'sendMessage']);