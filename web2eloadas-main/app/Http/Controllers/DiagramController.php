<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Allat;
use Illuminate\Support\Facades\DB;

class DiagramController extends Controller
{
    public function index()
    {
        // JAVÍTÁS: 'ertek.nev' helyett 'ertek.forint'-ot használunk, mert az a tábla oszlopneve
        // A CONCAT hozzáfűzi a " Ft" szöveget, hogy szebb legyen a diagram felirata (pl. "50000 Ft")

        $adatok = DB::table('allat')
            ->join('ertek', 'allat.ertekid', '=', 'ertek.id')
            ->select(DB::raw("CONCAT(ertek.forint, ' Ft') as cimke"), DB::raw('count(*) as darab'))
            ->groupBy('ertek.forint')
            ->get();

        // Adatok szétválogatása a Chart.js-nek
        $cimkek = $adatok->pluck('cimke');
        $ertekek = $adatok->pluck('darab');

        return view('diagram', compact('cimkek', 'ertekek'));
    }
}
