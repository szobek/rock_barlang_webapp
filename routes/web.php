<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/bands');
});
Route::get('bands', function () {
    $bands = App\Models\Band::with(['members', 'albums', 'styles'])->get();
    return view('page.bands', compact('bands'));
});
Route::get('bands/{id}', function ($id) {
    $band = App\Models\Band::with(['members', 'albums', 'styles'])->findOrFail($id);
    $styles = $band->styles->toArray();
    $style_string = '';
    foreach ($styles as $style) {
        $style_string .= $style['name'].', ';
    }
    $style_string = rtrim($style_string, ', ');
    return view('page.band_detail', compact('band', 'style_string'));
})->name('bands.show');

Route::get('albums', function () {
    $albums = App\Models\Album::with(['band', 'styles'])->get();
    return view('page.albums', compact('albums'));
});
Route::get('members', function () {
    $members = App\Models\Member::with(['band'])->get();
    return view('page.members', compact('members'));
});
