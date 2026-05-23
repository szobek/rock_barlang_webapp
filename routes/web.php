<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BandDetailController;


Route::get('/', function () {
    return redirect('/bands');
});
Route::get('bands', function () {
    $bands = App\Models\Band::with(['members', 'albums', 'styles'])->get();
    return view('page.bands', compact('bands'));
});

Route::get('band/{id}', [BandDetailController::class, 'show'])->name('band.show');


Route::get('albums', function () {
    $albums = App\Models\Album::with(['band', 'styles'])->get();
    return view('page.albums', compact('albums'));
});

Route::get('albums', function () {
    $albums = App\Models\Album::with(['band', 'styles'])->get();
    return view('page.albums', compact('albums'));
});
Route::get('members', function () {
    $members = App\Models\Member::with(['band'])->get();
    return view('page.members', compact('members'));
});

Route::get('style/{id}', [App\Http\Controllers\BandByStyleController::class, 'show'])->name('style.show');