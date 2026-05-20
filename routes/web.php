<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/bands');
});
Route::get('bands', function () {
    $bands = App\Models\Band::with(['members', 'albums', 'styles'])->get();
    return view('components.bands', compact('bands'));
});
Route::get('albums', function () {
    $albums = App\Models\Album::with(['band', 'styles'])->get();
    return view('components.albums', compact('albums'));
});
Route::get('members', function () {
    $members = App\Models\Member::with(['band'])->get();
    return view('components.members', compact('members'));
});
