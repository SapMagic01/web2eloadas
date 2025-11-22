<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Uzenet; // Importáljuk a modellt

class KapcsolatController extends Controller
{
    // Ez jeleníti meg az űrlapot
    public function index()
    {
        return view('kapcsolat');
    }
    public function uzenetek()
    {
        // Lekérjük az összes üzenetet, a legújabbal kezdve (created_at szerint csökkenő)
        $uzenetek = Uzenet::orderBy('created_at', 'desc')->get();

        return view('uzenetek', compact('uzenetek'));
    }

    // Ez menti el az adatokat (POST kérés)
    public function store(Request $request)
    {
        // 1. Szerver oldali validáció (Kötelező elem!)
        $validated = $request->validate([
            'nev' => 'required|min:3|max:255',
            'email' => 'required|email',
            'szoveg' => 'required|min:10',
        ], [
            // Egyedi hibaüzenetek (opcionális, de szép)
            'nev.required' => 'A név megadása kötelező!',
            'email.required' => 'Az email cím megadása kötelező!',
            'email.email' => 'Érvényes email címet adj meg!',
            'szoveg.required' => 'Az üzenet szövege nem lehet üres!',
            'szoveg.min' => 'Az üzenet legyen legalább 10 karakter hosszú.',
        ]);

        // 2. Mentés az adatbázisba (Kötelező elem!)
        Uzenet::create([
            'nev' => $validated['nev'],
            'email' => $validated['email'],
            'szoveg' => $validated['szoveg'],
        ]);


        // 3. Visszairányítás sikerüzenettel
        return redirect()->route('kapcsolat.index')->with('success', 'Köszönjük! Az üzenetedet sikeresen megkaptuk.');
    }
}
