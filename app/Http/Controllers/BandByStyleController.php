<?php

namespace App\Http\Controllers;
use App\Models\Band;
use Illuminate\Http\Request;

class BandByStyleController extends Controller
{
    public function show($style_id)
    {
        $bands = Band::whereHas('styles', function ($query) use ($style_id) {
        $query->where('styles.id', $style_id); // Ha a stílusok táblád id oszlopa 'id'
    })
    ->with(['members', 'albums', 'styles']) // Opcionális: betölti a többi kapcsolatot is, hogy ne legyen N+1 probléma
    ->get();

        
        return view('page.bands_by_style', compact('bands'));
    }
}
