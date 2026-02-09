<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator SUS | Portofolio Web</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased">

    <div class="max-w-4xl mx-auto py-16 px-6">
        
        <div class="text-center mb-16">
            <h1 class="text-5xl font-extrabold tracking-tight text-slate-900 mb-4">
                SUS <span class="text-indigo-600">Calculator</span>
            </h1>
            <p class="text-lg text-slate-500 max-w-2xl mx-auto">
                Ukur tingkat kemudahan penggunaan sistem Anda menggunakan standar industri <span class="font-semibold text-slate-700">System Usability Scale (SUS)</span>.
            </p>
        </div>

        @if(isset($skor))
        <div class="bg-white rounded-3xl p-10 shadow-2xl shadow-indigo-100 border border-indigo-50 mb-12 text-center transform transition-all animate-bounce-short">
            <h2 class="text-sm font-bold text-indigo-400 uppercase tracking-[0.2em] mb-4">Hasil Analisis</h2>
            <div class="flex flex-col items-center">
                <span class="text-8xl font-black text-slate-900 mb-2">{{ $skor }}</span>
                <div class="px-6 py-2 bg-indigo-600 text-white rounded-full font-bold text-lg shadow-lg shadow-indigo-200">
                    Grade: {{ $keterangan }}
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-slate-100">
                <a href="/" class="text-indigo-600 hover:text-indigo-800 font-bold transition flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                    </svg>
                    Hitung Ulang
                </a>
            </div>
        </div>
        @endif

        <form action="{{ route('sus.hitung') }}" method="POST" class="space-y-6">
            @csrf
            <div class="bg-white rounded-3xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-8 md:p-12 space-y-12">
                    
                    @php
                        $pertanyaan = [
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

                    @foreach($pertanyaan as $index => $item)
                    <div class="group">
                        <div class="flex items-start gap-4 mb-6">
                            <span class="flex-shrink-0 w-8 h-8 rounded-full bg-slate-100 text-slate-500 flex items-center justify-center font-bold text-sm group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                {{ $index + 1 }}
                            </span>
                            <p class="text-xl font-semibold text-slate-800 leading-tight">
                                {{ $item }}
                            </p>
                        </div>

                        <div class="grid grid-cols-5 gap-2 md:gap-4 max-w-xl ml-12">
                            @for($i = 1; $i <= 5; $i++)
                            <label class="relative flex flex-col items-center group cursor-pointer">
                                <input type="radio" name="jawaban[{{ $index }}]" value="{{ $i }}" required 
                                    class="peer sr-only">
                                <div class="w-full py-4 rounded-2xl border-2 border-slate-100 text-slate-400 font-bold text-center transition-all 
                                    peer-checked:border-indigo-600 peer-checked:bg-indigo-50 peer-checked:text-indigo-600 
                                    hover:border-slate-200 hover:bg-slate-50">
                                    {{ $i }}
                                </div>
                                @if($i == 1)
                                    <span class="absolute -bottom-6 text-[10px] font-bold text-slate-400 uppercase tracking-tighter whitespace-nowrap">Sangat Tidak Setuju</span>
                                @elseif($i == 5)
                                    <span class="absolute -bottom-6 text-[10px] font-bold text-indigo-500 uppercase tracking-tighter whitespace-nowrap">Sangat Setuju</span>
                                @endif
                            </label>
                            @endfor
                        </div>
                    </div>
                    @endforeach

                </div>

                <div class="bg-slate-50 p-8 md:p-12 border-t border-slate-100">
                    <button type="submit" class="w-full bg-slate-900 hover:bg-indigo-600 text-white font-extrabold py-5 rounded-2xl shadow-xl shadow-slate-200 transition-all transform active:scale-[0.98] flex items-center justify-center gap-3 text-lg">
                        Kalkulasi Skor Sekarang
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                        </svg>
                    </button>
                    <p class="text-center text-slate-400 text-sm mt-6">
                        Pastikan semua pertanyaan telah dijawab untuk hasil yang akurat.
                    </p>
                </div>
            </div>
        </form>

        <footer class="mt-20 text-center border-t border-slate-200 pt-8">
            <p class="text-slate-400 text-sm font-medium">
                &copy; {{ date('Y') }} — Dikembangkan oleh <span class="text-slate-900">Albertus Gilardino</span>
            </p>
        </div>
    </div>

</body>
</html>