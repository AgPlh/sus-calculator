<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SusController extends Controller
{
    // Menampilkan halaman formulir kuesioner
    public function indeks()
    {
        return view('sus-calculator');
    }

    // Memproses data dan menghitung skor SUS
    public function hitung(Request $request)
    {
        // Validasi: pastikan data 'jawaban' ada, berjumlah 10, dan nilainya antara 1-5
        $request->validate([
            'jawaban' => 'required|array|size:10',
            'jawaban.*' => 'required|integer|between:1,5',
        ]);

        $daftarJawaban = $request->input('jawaban');
        $totalSkor = 0;

        foreach ($daftarJawaban as $indeks => $nilai) {
            $nomorPertanyaan = $indeks + 1;

            // Logika Perhitungan SUS:
            // 1. Pertanyaan Ganjil (1,3,5,7,9): Nilai dikurangi 1
            // 2. Pertanyaan Genap (2,4,6,8,10): 5 dikurangi Nilai
            if ($nomorPertanyaan % 2 != 0) {
                $totalSkor += ($nilai - 1);
            } else {
                $totalSkor += (5 - $nilai);
            }
        }

        // Skor akhir didapat dari total skor sementara dikali 2.5
        $skorAkhir = $totalSkor * 2.5;

        return view('sus-calculator', [
            'skor' => $skorAkhir,
            'keterangan' => $this->tentukanGrade($skorAkhir)
        ]);
    }

    // Fungsi internal untuk menentukan predikat berdasarkan skor
    private function tentukanGrade($skor)
    {
        if ($skor >= 80.3) {
            return 'A (Sangat Baik)';
        } elseif ($skor >= 68) {
            return 'B/C (Baik)';
        } elseif ($skor >= 51) {
            return 'D (Cukup)';
        } else {
            return 'F (Kurang)';
        }
    }
}