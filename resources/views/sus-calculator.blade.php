<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator SUS | Portofolio Saya</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 antialiased font-sans">

    <div class="max-w-3xl mx-auto py-12 px-4">
        <header class="text-center mb-10">
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Kalkulator SUS</h1>
            <p class="text-gray-600 underline decoration-indigo-500 decoration-2">System Usability Scale</p>
        </header>

        @if(isset($skor))
        <div class="bg-white border-l-8 border-indigo-600 rounded-xl p-8 mb-10 shadow-md text-center">
            <h2 class="text-sm font-bold text-gray-400 uppercase tracking-widest">Hasil Perhitungan</h2>
            <div class="text-7xl font-black text-indigo-600 my-3">{{ $skor }}</div>
            <p class="text-xl font-medium text-gray-700">Predikat: <span class="text-indigo-600">{{ $keterangan }}</span></p>
            <div class="mt-6">
                <a href="/" class="text-indigo-500 hover:text-indigo-700 font-semibold text-sm">↺ Hitung Ulang</a>
            </div>
        </div>
        @endif

        <form action="{{ route('sus.hitung') }}" method="POST" class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
            @csrf
            <div class="p-8 space-y-10">
                @php
                    $daftarPertanyaan = [
                        "Saya rasa saya akan sering menggunakan sistem ini.",
                        "Saya merasa sistem ini rumit untuk digunakan.",
                        "Saya rasa sistem ini mudah digunakan.",
                        "Saya rasa saya butuh bantuan orang teknis untuk menggunakan sistem ini.",
                        "Saya rasa fitur-fitur dalam sistem ini terintegrasi dengan baik.",
                        "Saya rasa terlalu banyak ketidakkonsistenan pada sistem ini.",
                        "Saya rasa orang lain akan belajar menggunakan sistem ini dengan sangat cepat.",
                        "Saya merasa sistem ini membingungkan untuk digunakan.",
                        "Saya merasa tidak ada hambatan saat menggunakan sistem ini.",
                        "Saya butuh membiasakan diri terlebih dahulu sebelum menggunakan sistem ini."
                    ];
                @endphp

                @foreach($daftarPertanyaan as $indeks => $pertanyaan)
                <div class="group">
                    <p class="text-lg font-semibold text-gray-800 mb-5 group-hover:text-indigo-600 transition">
                        <span class="opacity-30 mr-2">{{ $indeks + 1 }}.</span> {{ $pertanyaan }}
                    </p>
                    
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 bg-gray-50 p-4 rounded-xl">
                        <span class="text-xs font-bold text-gray-400 uppercase">Sangat Tidak Setuju</span>
                        
                        <div class="flex space-x-2 sm:space-x-6">
                            @for($i = 1; $i <= 5; $i++)
                            <label class="flex flex-col items-center cursor-pointer">
                                <input type="radio" name="jawaban[{{ $indeks }}]" value="{{ $i }}" required 
                                    class="w-6 h-6 text-indigo-600 focus:ring-indigo-500 border-gray-300 transition">
                                <span class="mt-2 text-xs font-bold text-gray-500">{{ $i }}</span>
                            </label>
                            @endfor
                        </div>

                        <span class="text-xs font-bold text-indigo-400 uppercase">Sangat Setuju</span>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="bg-gray-100 p-6">
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 rounded-xl shadow-lg transition-all transform active:scale-[0.98]">
                    Dapatkan Skor Usability
                </button>
            </div>
        </form>

        <footer class="mt-12 text-center text-gray-400 text-xs">
            &copy; {{ date('Y') }} 
        </footer>
    </div>

</body>
</html>