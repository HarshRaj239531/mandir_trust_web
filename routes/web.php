<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/poojas', function () {
    return view('poojas');
})->name('poojas');

Route::get('/donate', function () {
    return view('donate');
})->name('donate');

Route::get('/events', function () {
    return view('events');
})->name('events');

Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');

Route::get('/facilities', function () {
    return view('facilities');
})->name('facilities');
