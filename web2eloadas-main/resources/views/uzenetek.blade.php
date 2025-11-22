<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Beérkezett Üzenetek</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-green-50 text-gray-800 font-sans flex flex-col min-h-screen">

<!-- MENÜSOR -->
<nav class="bg-green-800 text-white shadow-md p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="{{ url('/') }}" class="flex items-center gap-2 hover:text-green-200 transition">
            <i class="fa-solid fa-leaf"></i>
            <span class="text-xl font-semibold tracking-wide">Természetvédelem</span>
        </a>

        <div class="space-x-6 text-sm font-medium flex items-center">
            <a href="{{ url('/') }}" class="hover:text-green-200 transition">Főoldal</a>
            <a href="{{ route('allat.index') }}" class="hover:text-green-200 transition">Adatbázis</a>
            <a href="{{ route('kapcsolat.index') }}" class="hover:text-green-200 transition">Kapcsolat</a>

            <!-- Itt már biztosan be vagyunk lépve, mert a Route védi az oldalt -->
            <a href="{{ route('uzenetek.index') }}" class="text-green-200 underline font-bold">
                <i class="fa-solid fa-envelope-open-text"></i> Üzenetek
            </a>

            <a href="{{ url('/dashboard') }}" class="bg-white text-green-800 px-3 py-1 rounded hover:bg-gray-100 transition">Vezérlőpult</a>
        </div>
    </div>
</nav>

<!-- TARTALOM -->
<main class="flex-grow container mx-auto px-4 py-10">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-green-900">Beérkezett Üzenetek</h1>
        <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-sm font-semibold">
                Összesen: {{ $uzenetek->count() }} db
            </span>
    </div>

    <div class="bg-white rounded-lg shadow-lg overflow-hidden border border-green-100">
        <div class="overflow-x-auto">
            <table class="min-w-full leading-normal">
                <thead>
                <tr>
                    <th class="px-5 py-3 border-b-2 border-green-200 bg-green-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                        Időpont
                    </th>
                    <th class="px-5 py-3 border-b-2 border-green-200 bg-green-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                        Küldő Neve
                    </th>
                    <th class="px-5 py-3 border-b-2 border-green-200 bg-green-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                        Email Cím
                    </th>
                    <th class="px-5 py-3 border-b-2 border-green-200 bg-green-700 text-left text-xs font-semibold text-white uppercase tracking-wider">
                        Üzenet
                    </th>
                </tr>
                </thead>
                <tbody>
                @forelse($uzenetek as $uzenet)
                    <tr class="hover:bg-green-50 border-b border-gray-200">
                        <!-- IDŐPONT MEGJELENÍTÉSE -->
                        <td class="px-5 py-4 text-sm whitespace-nowrap text-gray-500">
                            <i class="fa-regular fa-clock mr-1"></i>
                            {{ $uzenet->created_at->format('Y.m.d H:i') }}
                        </td>
                        <td class="px-5 py-4 text-sm font-bold text-green-900">
                            {{ $uzenet->nev }}
                        </td>
                        <td class="px-5 py-4 text-sm text-blue-600">
                            <a href="mailto:{{ $uzenet->email }}">{{ $uzenet->email }}</a>
                        </td>
                        <td class="px-5 py-4 text-sm text-gray-700 italic">
                            "{{Str::limit($uzenet->szoveg, 50)}}"
                            <!-- Ha rákattint, felugorhatna, vagy külön oldalon, de itt most csak listázunk -->
                            <div class="text-xs text-gray-400 mt-1 full-text hidden">{{ $uzenet->szoveg }}</div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-5 py-10 text-center text-gray-500">
                            <i class="fa-regular fa-folder-open text-4xl mb-3 block"></i>
                            Még nem érkezett üzenet.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</main>

<footer class="bg-green-900 text-green-100 text-center py-6 mt-auto">
    <div class="container mx-auto">
        <p>&copy; {{ date('Y') }} Védett Állatok Nyilvántartása</p>
    </div>
</footer>
</body>
</html>
