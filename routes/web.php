<?php

use Illuminate\Support\Facades\Route;

// Main route - Livewire-based (Production)
Route::get('/', function () {
    return view('welcome');
});
