<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Album;
use App\Models\Band;
use App\Models\Member;
use App\Models\Style;

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

        // 4. STÍLUSOK BEOLVASÁSA ÉS ÖSSZEKÖTÉSE
        $stilusCsv = Http::withoutVerifying()->get("https://docs.google.com/spreadsheets/d/{$spreadsheetId}/gviz/tq?tqx=out:csv&sheet=stílus")->body();
        $stilusSorok = array_map('str_getcsv', explode("\n", trim($stilusCsv)));
        array_shift($stilusSorok);

        foreach ($stilusSorok as $sor) {
            // $sor[0] = stílus (pl. rock), $sor[1] = együttes neve
            if (!empty($sor[0]) && !empty($sor[1])) {
                $band = Band::whereRaw('LOWER(name) = ?', [strtolower(trim($sor[1]))])->first();

                if ($band) {
                    Style::create([
                        'name' => trim($sor[0]),
                        'band_id' => $band->id
                    ]);
                }
            }
        }
    }
}
