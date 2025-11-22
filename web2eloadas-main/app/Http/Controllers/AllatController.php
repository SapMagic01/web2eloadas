<?php

namespace App\Http\Controllers;

use App\Models\Allat;
use App\Models\Ertek;     // Feltételezem, hogy létezik, mivel van rá hivatkozás
use App\Models\Kategoria; // Feltételezem, hogy létezik, mivel van rá hivatkozás
use Illuminate\Http\Request;

class AllatController extends Controller
{
    /**
     * Megjeleníti az összes állatot (táblázatos nézet).
     */
    public function index()
    {
        // Eager loading (with) használata a 'kategoria' és 'ertek' kapcsolatokhoz a jobb teljesítményért
        $allatok = Allat::with(['kategoria', 'ertek'])->get();

        return view('adatbazis', compact('allatok'));
    }

    /**
     * Megjeleníti az új állat létrehozása űrlapot.
     */
    public function create()
    {
        // Szükség van a kategóriákra és értékekre a <select> (legördülő) mezőkhöz
        $kategoriak = Kategoria::all();
        $ertekek = Ertek::all();

        return view('allat.create', compact('kategoriak', 'ertekek'));
    }

    /**
     * Eltárolja az új állatot az adatbázisban.
     */
    public function store(Request $request)
    {
        // Szerver oldali validáció (Kötelező elem a beadandóban!)
        $validated = $request->validate([
            'nev' => 'required|string|max:255',
            'ev' => 'required|integer|min:1900|max:' . date('Y'),
            'ertekid' => 'required|exists:ertek,id',       // Ellenőrzi, hogy létezik-e ilyen ID az 'ertek' táblában
            'katid' => 'required|exists:kategoria,id',      // Ellenőrzi, hogy létezik-e ilyen ID a 'kategoria' táblában
        ]);

        // Létrehozás
        Allat::create($validated);

        return redirect()->route('allat.index')->with('success', 'Állat sikeresen hozzáadva!');
    }

    /**
     * Megjeleníti a szerkesztési űrlapot egy adott állathoz.
     */
    public function edit($id)
    {
        $allat = Allat::findOrFail($id);
        $kategoriak = Kategoria::all();
        $ertekek = Ertek::all();

        return view('allat.edit', compact('allat', 'kategoriak', 'ertekek'));
    }

    /**
     * Frissíti az adott állat adatait az adatbázisban.
     */
    public function update(Request $request, $id)
    {
        // Validáció
        $validated = $request->validate([
            'nev' => 'required|string|max:255',
            'ev' => 'required|integer|min:1900|max:' . date('Y'),
            'ertekid' => 'required|exists:ertek,id',
            'katid' => 'required|exists:kategoria,id',
        ]);

        // Frissítés
        $allat = Allat::findOrFail($id);
        $allat->update($validated);

        return redirect()->route('allat.index')->with('success', 'Állat adatai sikeresen frissítve!');
    }

    /**
     * Törli az adott állatot.
     */
    public function destroy($id)
    {
        $allat = Allat::findOrFail($id);
        $allat->delete();

        return redirect()->route('allat.index')->with('success', 'Állat sikeresen törölve!');
    }
}
