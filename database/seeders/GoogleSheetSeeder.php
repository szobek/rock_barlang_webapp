<?php

namespace Database\Seeders;

// use Illuminate\Support\Facades\Facades\Log;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Album;
use App\Models\Band;
use App\Models\Member;
use App\Models\Style;
use App\Models\Track;
use App\Models\BandStyle;

class GoogleSheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // A táblázatod egyedi azonosítója (a linkedből másolva)
        $spreadsheetId = '1w8x_m6tEhzCpLBzaCs-gtAWvazWUHEtf4RgC98YUb8E';

        // 1. EGYÜTTESEK BEOLVASÁSA ÉS MENTÉSE
        // Lekérjük a Google-től az "együttesek" nevű fület CSV formátumban
        $egyuttesekCsv = Http::withoutVerifying()->get("https://docs.google.com/spreadsheets/d/{$spreadsheetId}/gviz/tq?tqx=out:csv&sheet=együttesek")->body();
        $egyuttesekSorok = array_map('str_getcsv', explode("\n", trim($egyuttesekCsv)));

        // Kihagyjuk a fejlécet (első sor)
        array_shift($egyuttesekSorok);

        foreach ($egyuttesekSorok as $sor) {
            if (!empty($sor[0])) {
                $formedYear = !empty(trim($sor[2])) && is_numeric(trim($sor[2])) ? intval(trim($sor[2])) : null;

                Band::updateOrCreate(
                    ['name' => trim($sor[0])],
                    [
                        'description' => trim($sor[1]),
                        'formed_year' => $formedYear, // Az így megtisztított változót adjuk át
                        'image_path' => !empty(trim($sor[3])) ? trim($sor[3]) : null
                    ]
                );
            }
        }

        // 2. TAGOK BEOLVASÁSA ÉS ÖSSZEKÖTÉSE
        $tagokCsv = Http::withoutVerifying()->get("https://docs.google.com/spreadsheets/d/{$spreadsheetId}/gviz/tq?tqx=out:csv&sheet=tagok")->body();
        $tagokSorok = array_map('str_getcsv', explode("\n", trim($tagokCsv)));
        array_shift($tagokSorok); // Fejléc leugrik

        foreach ($tagokSorok as $sor) {
            if (!empty($sor[0]) && !empty($sor[1])) {
                $band = Band::whereRaw('LOWER(name) = ?', [strtolower(trim($sor[1]))])->first();

                if ($band) {
                    Member::create([
                        'name' => trim($sor[0]),
                        'band_id' => $band->id,
                        'role' => !empty(trim($sor[2])) ? trim($sor[2]) : null
                    ]);
                }
            }
        }

        // 3. ALBUMOK BEOLVASÁSA ÉS ÖSSZEKÖTÉSE
        $albumokCsv = Http::withoutVerifying()->get("https://docs.google.com/spreadsheets/d/{$spreadsheetId}/gviz/tq?tqx=out:csv&sheet=album")->body();
        $albumokSorok = array_map('str_getcsv', explode("\n", trim($albumokCsv)));
        array_shift($albumokSorok);

        foreach ($albumokSorok as $sor) {
            // $sor[0] = album neve, $sor[1] = együttes neve
            if (!empty($sor[0]) && !empty($sor[1])) {
                $band = Band::whereRaw('LOWER(name) = ?', [strtolower(trim($sor[1]))])->first();

                if ($band) {
                    Album::create([
                        'name' => trim($sor[0]),
                        'band_id' => $band->id,
                        'release_year' => !empty(trim($sor[2])) && is_numeric(trim($sor[2])) ? intval(trim($sor[2])) : null
                    ]);
                }
            }
        }

        // 4. STÍLUSOK BEOLVASÁSA 
        $stilusCsv = Http::withoutVerifying()->get("https://docs.google.com/spreadsheets/d/{$spreadsheetId}/gviz/tq?tqx=out:csv&sheet=stílusok")->body();
        $stilusSorok = array_map('str_getcsv', explode("\n", trim($stilusCsv)));
        array_shift($stilusSorok);

        foreach ($stilusSorok as $sor) {
            // $sor[0] = stílus (pl. rock), $sor[1] = együttes neve
            if (!empty($sor[0])) {
                Style::create([
                    'name' => trim($sor[0]),
                ]);
            }
        }

        // a számok beolvasása és összekötése a bandákkal és albumokkal
        $szamokCsv = Http::withoutVerifying()->get("https://docs.google.com/spreadsheets/d/{$spreadsheetId}/gviz/tq?tqx=out:csv&sheet=zenék")->body();
        $szamokSorok = array_map('str_getcsv', explode("\n", trim($szamokCsv)));
        array_shift($szamokSorok);

        foreach ($szamokSorok as $sor) {
            if (!empty($sor[0]) && !empty($sor[1])) {
                $band = Band::whereRaw('LOWER(name) = ?', [strtolower($sor[5])])->first();
                $album = Album::whereRaw('LOWER(name) = ?', [strtolower($sor[4])])->first();
                $duration = !empty($sor[1]) ? $sor[1] : null;
                if ($band && $album) {

                    Track::create([
                        'title' => $sor[0],
                        'band_id' => $band->id,
                        'album_id' => $album->id,
                        'duration' => $duration,
                        'url' => !empty($sor[2]) ? $sor[2] : null,
                        'description' => !empty($sor[3]) ? $sor[3] : null
                    ]);
                } else {
                    echo "Kihagyva (adatbázis hiány): " . $sor[0] . " | Banda: " . $sor[5] . " | Album: " . $sor[4] . "\n";
                }
            }
        }

        // ********************************************************************************************************************************************************

        //  EGYÜTTESEK ÉS STÍLUSOK ÖSSZEKÖTÉSE
        $banda_stilusCsv = Http::withoutVerifying()->get("https://docs.google.com/spreadsheets/d/{$spreadsheetId}/gviz/tq?tqx=out:csv&sheet=együttes-stílus")->body();
        $banda_stilusSorok = array_map('str_getcsv', explode("\n", trim($banda_stilusCsv)));
        array_shift($banda_stilusSorok);

        foreach ($banda_stilusSorok as $sor) {
            if (!empty($sor[0]) && !empty($sor[1])) {
                $band = Band::whereRaw('LOWER(name) = ?', [strtolower(trim($sor[1]))])->first();
                $style = Style::whereRaw('LOWER(name) = ?', [strtolower(trim($sor[0]))])->first();

                if ($band && $style) {
                    BandStyle::updateOrCreate(
                        ['band_id' => $band->id, 'style_id' => $style->id],
                        []
                    );
                }
            }
        }
    }
}
