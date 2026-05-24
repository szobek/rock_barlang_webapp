<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AlbumDetailController extends Controller
{
    public function show($id)
    {
        $album = \App\Models\Album::with(['band','tracks'])->findOrFail($id);
        return view('page.album_detail', compact('album'));
    }
}
