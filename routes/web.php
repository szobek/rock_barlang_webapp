<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/bands');
});
Route::get('bands', function () {
    $bands = App\Models\Band::with(['members', 'albums', 'styles'])->get();
    return view('components.bands', compact('bands'));
});
