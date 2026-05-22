<?php

namespace App\Http\Controllers;

use App\Models\Band;

class BandDetailController extends Controller
{


    /**
     *
     * @param  int  $id
     */
    public function show($id)
    {
        $band = Band::with(['members', 'albums', 'styles'])->findOrFail($id);
        $styles = $band->styles;
        $style_string = '';
        foreach ($styles as $style) {
            $style_string .= '<a href="/style/' . $style->id . '">' . htmlspecialchars($style->name) . '</a>, ';
        }
        $style_string = rtrim($style_string, ', ');
        return view('page.band_detail', compact('band', 'style_string'));
    }
}
