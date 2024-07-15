<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use DateTime;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getHariBesarIndonesia()
    {
        // Coba ambil dari API Hari Libur
        // Kalo API nya bermasalah, maka ambil data Hari Libur dari data statis
        try {
            $source = file_get_contents("https://raw.githubusercontent.com/guangrei/APIHariLibur_V2/main/holidays.json");
        } catch (\Throwable $th) {
            $source = $this->hariLiburIndonesia();
        }

        // Lakukan json_decode, lalu jadikan collect
        $data = collect(json_decode($source, true))
            // Ambil key nya aja, karena key nya adalah tanggal libur nya
            ->keys()
            // Buang 1 item yang paling belakang, karena itu adalah info pembuat API nya
            ->slice(0, -1)
            // Lakukan format terhadap key nya agar mengembalikan format tgl "Y-m-d"
            // NOTE : Meskipun bentuk key nya sudah sesuai format tgl, tetapi hal ini tetap harus dilakukan
            //        agar format tgl nya selalu konsisten bila suatu waktu bentuk key nya berubah
            ->map(function ($item) {
                $y = new DateTime($item);
                return $y->format('Y-m-d');
            });

        return $data;
    }

    protected function hariLiburIndonesia()
    {
        return '{
            "2024-01-01": {
                "summary": "Hari Tahun Baru"
            },
            "2024-02-08": {
                "summary": "Isra Mikraj Nabi Muhammad"
            },
            "2024-02-09": {
                "summary": "Cuti Bersama Tahun Baru Imlek"
            },
            "2024-02-10": {
                "summary": "Tahun Baru Imlek"
            },
            "2024-02-14": {
                "summary": "Hari Pemilihan"
            },
            "2024-03-11": {
                "summary": "Hari Suci Nyepi (Tahun Baru Saka)"
            },
            "2024-03-12": {
                "summary": "Cuti Bersama Hari Suci Nyepi (Tahun Baru Saka)"
            },
            "2024-03-29": {
                "summary": "Wafat Isa Almasih"
            },
            "2024-03-31": {
                "summary": "Hari Paskah"
            },
            "2024-04-08": {
                "summary": "Cuti Bersama Idul Fitri"
            },
            "2024-04-09": {
                "summary": "Cuti Bersama Idul Fitri"
            },
            "2024-04-10": {
                "summary": "Hari Idul Fitri"
            },
            "2024-04-11": {
                "summary": "Hari Idul Fitri"
            },
            "2024-04-12": {
                "summary": "Cuti Bersama Idul Fitri"
            },
            "2024-04-15": {
                "summary": "Cuti Bersama Idul Fitri"
            },
            "2024-05-01": {
                "summary": "Hari Buruh Internasional / Pekerja"
            },
            "2024-05-09": {
                "summary": "Kenaikan Isa Al Masih"
            },
            "2024-05-10": {
                "summary": "Cuti Bersama Kenaikan Isa Al Masih"
            },
            "2024-05-23": {
                "summary": "Hari Raya Waisak"
            },
            "2024-05-24": {
                "summary": "Cuti Bersama Waisak"
            },
            "2024-06-01": {
                "summary": "Hari Lahir Pancasila"
            },
            "2024-06-17": {
                "summary": "Idul Adha (Lebaran Haji)"
            },
            "2024-06-18": {
                "summary": "Idul Adha (Lebaran Haji)"
            },
            "2024-07-07": {
                "summary": "Satu Muharam / Tahun Baru Hijriah"
            },
            "2024-08-17": {
                "summary": "Hari Proklamasi Kemerdekaan R.I."
            },
            "2024-09-15": {
                "summary": "Maulid Nabi Muhammad"
            },
            "2024-12-25": {
                "summary": "Hari Raya Natal"
            },
            "2024-12-26": {
                "summary": "Cuti Bersama Natal (Hari Tinju)"
            },
            "2025-01-01": {
                "summary": "Hari Tahun Baru"
            },
            "2025-01-28": {
                "summary": "Isra Mikraj Nabi Muhammad"
            },
            "2025-01-29": {
                "summary": "Tahun Baru Imlek"
            },
            "2025-04-01": {
                "summary": "Hari Idul Fitri"
            },
            "2025-04-02": {
                "summary": "Hari Idul Fitri"
            },
            "2025-04-18": {
                "summary": "Wafat Isa Almasih"
            },
            "2025-05-01": {
                "summary": "Hari Buruh Internasional / Pekerja"
            },
            "2025-05-13": {
                "summary": "Hari Raya Waisak"
            },
            "2025-05-29": {
                "summary": "Kenaikan Isa Al Masih"
            },
            "2025-06-01": {
                "summary": "Hari Lahir Pancasila"
            },
            "2025-06-07": {
                "summary": "Idul Adha (Lebaran Haji)"
            },
            "2025-06-27": {
                "summary": "Satu Muharam / Tahun Baru Hijriah"
            },
            "2025-08-17": {
                "summary": "Hari Proklamasi Kemerdekaan R.I."
            },
            "2025-09-05": {
                "summary": "Maulid Nabi Muhammad"
            },
            "2025-12-25": {
                "summary": "Hari Raya Natal"
            },
            "info": {
                "author": "guangrei",
                "link": "https://github.com/guangrei",
                "updated": "20240426 22:10:49"
            }
        }';
    }
}
