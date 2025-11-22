<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Védett Állatok Listája</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-green-50 text-gray-800 font-sans flex flex-col min-h-screen">

<!-- 1. MENÜSOR -->
<nav class="bg-green-800 text-white shadow-md p-4 mb-8">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ url('/') }}" class="flex items-center gap-2 hover:text-green-200 transition">
            <i class="fa-solid fa-leaf"></i>
            <span class="text-xl font-semibold tracking-wide">Természetvédelem</span>
        </a>

        <div class="space-x-6 text-sm font-medium flex items-center">
            <a href="{{ url('/') }}" class="hover:text-green-200 transition">Főoldal</a>
            <!-- Itt most az aktív oldal jelölése (underline) -->
            <a href="{{ route('allat.index') }}" class="text-green-200 underline">Adatbázis</a>

            <!-- MENÜBEN IS OTT A STATISZTIKA -->
            <a href="{{ route('diagram.index') }}" class="hover:text-green-200 transition">
                <i class="fa-solid fa-chart-pie"></i> Statisztika
            </a>

            <a href="{{ route('kapcsolat.index') }}" class="hover:text-green-200 transition">Kapcsolat</a>

            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.index') }}" class="text-red-500 hover:text-red-700 font-bold transition uppercase mr-2">
                        <i class="fa-solid fa-lock"></i> ADMIN
                    </a>
                @endif
                <a href="{{ route('uzenetek.index') }}" class="hover:text-green-200 transition">Üzenetek</a>
                <a href="{{ url('/dashboard') }}" class="bg-white text-green-800 px-3 py-1 rounded hover:bg-gray-100 transition">Vezérlőpult</a>
            @else
                <a href="{{ route('login') }}" class="hover:text-green-200 transition">Belépés</a>
            @endauth
        </div>
    </div>
</nav>

<!-- 2. TARTALOM -->
<main class="flex-grow container mx-auto px-4 pb-12">

    <!-- FEJLÉC ÉS GOMBOK -->
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <h1 class="text-3xl font-bold text-green-900">Nyilvántartott Fajok</h1>

        <!-- GOMBOK CSOPORTJA -->
        <div class="flex gap-3">
            <!-- ITT A SÁRGA STATISZTIKA GOMB -->
            <a href="{{ route('diagram.index') }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded shadow transition flex items-center">
                <i class="fa-solid fa-chart-pie mr-2"></i> Statisztika megtekintése
            </a>

            <!-- ÚJ ÁLLAT GOMB -->
            <a href="{{ route('allat.create') }}" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded shadow transition flex items-center">
                <i class="fa-solid fa-plus mr-2"></i> Új állat felvétele
            </a>
        </div>
    </div>

    <!-- SIKERÜZENET -->
    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 shadow-sm" role="alert">
            <p class="font-bold">Siker!</p>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <!-- TÁBLÁZAT -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-green-100">
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-green-200 bg-green-100 text-left text-xs font-semibold text-green-700 uppercase tracking-wider">ID</th>
                    <th class="px-5 py-3 border-b-2 border-green-200 bg-green-100 text-left text-xs font-semibold text-green-700 uppercase tracking-wider">Név</th>
                    <th class="px-5 py-3 border-b-2 border-green-200 bg-green-100 text-left text-xs font-semibold text-green-700 uppercase tracking-wider">Év</th>
                    <th class="px-5 py-3 border-b-2 border-green-200 bg-green-100 text-left text-xs font-semibold text-green-700 uppercase tracking-wider">Kategória</th>
                    <th class="px-5 py-3 border-b-2 border-green-200 bg-green-100 text-left text-xs font-semibold text-green-700 uppercase tracking-wider">Eszmei Érték</th>
                    <th class="px-5 py-3 border-b-2 border-green-200 bg-green-100 text-right text-xs font-semibold text-green-700 uppercase tracking-wider">Műveletek</th>
                </tr>
                </thead>
                <tbody>
                @forelse($allatok as $allat)
                    <tr class="hover:bg-green-50 border-b border-gray-200 transition">
                        <td class="px-5 py-4 text-sm font-bold text-gray-700">{{ $allat->id }}</td>
                        <td class="px-5 py-4 text-sm text-gray-900 font-medium">{{ $allat->nev }}</td>
                        <td class="px-5 py-4 text-sm text-gray-600">{{ $allat->ev }}</td>
                        <td class="px-5 py-4 text-sm">
                                    <span class="px-3 py-1 font-semibold text-green-800 bg-green-200 rounded-full text-xs">
                                        {{ $allat->kategoria->nev ?? $allat->katid }}
                                    </span>
                        </td>
                        <td class="px-5 py-4 text-sm font-mono text-gray-700">
                            {{ number_format($allat->ertek->forint ?? 0, 0, ',', ' ') }} Ft
                        </td>
                        <td class="px-5 py-4 text-sm text-right">
                            <div class="flex items-center justify-end gap-3">
                                <a href="{{ route('allat.edit', $allat->id) }}" class="text-blue-600 hover:text-blue-800 transition" title="Szerkesztés">
                                    <i class="fa-solid fa-pen-to-square fa-lg"></i>
                                </a>

                                <form action="{{ route('allat.destroy', $allat->id) }}" method="POST" onsubmit="return confirm('Biztosan törölni szeretnéd ezt az állatot?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 transition" title="Törlés">
                                        <i class="fa-solid fa-trash-can fa-lg"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-8 text-center text-gray-500">
                            <i class="fa-solid fa-box-open text-4xl mb-3 block text-gray-300"></i>
                            Nincs megjeleníthető adat az adatbázisban.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- LÁBLÉC -->
<footer class="bg-green-900 text-green-100 text-center py-6 mt-auto">
    <div class="container mx-auto">
        <p>&copy; {{ date('Y') }} Védett Állatok Nyilvántartása</p>
    </div>
</footer>

</body>
</html>
