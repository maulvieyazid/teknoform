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
            "2023-01-01": {
                "summary": "Hari Tahun Baru"
            },
            "2023-01-22": {
                "summary": "Tahun Baru Imlek"
            },
            "2023-01-23": {
                "summary": "Cuti Bersama Tahun Baru Imlek"
            },
            "2023-02-18": {
                "summary": "Isra Mikraj Nabi Muhammad"
            },
            "2023-03-22": {
                "summary": "Hari Suci Nyepi (Tahun Baru Saka)"
            },
            "2023-03-23": {
                "summary": "Cuti Bersama Hari Suci Nyepi (Tahun Baru Saka)"
            },
            "2023-04-07": {
                "summary": "Wafat Isa Almasih"
            },
            "2023-04-19": {
                "summary": "Cuti Bersama Idul Fitri"
            },
            "2023-04-20": {
                "summary": "Cuti Bersama Idul Fitri"
            },
            "2023-04-21": {
                "summary": "Cuti Bersama Idul Fitri"
            },
            "2023-04-22": {
                "summary": "Hari Idul Fitri"
            },
            "2023-04-23": {
                "summary": "Hari Idul Fitri"
            },
            "2023-04-24": {
                "summary": "Cuti Bersama Idul Fitri"
            },
            "2023-04-25": {
                "summary": "Cuti Bersama Idul Fitri"
            },
            "2023-05-01": {
                "summary": "Hari Buruh Internasional / Pekerja"
            },
            "2023-05-18": {
                "summary": "Kenaikan Isa Al Masih"
            },
            "2023-06-01": {
                "summary": "Hari Lahir Pancasila"
            },
            "2023-06-02": {
                "summary": "Cuti Bersama Waisak"
            },
            "2023-06-04": {
                "summary": "Hari Raya Waisak"
            },
            "2023-06-29": {
                "summary": "Idul Adha (Lebaran Haji)"
            },
            "2023-07-19": {
                "summary": "Satu Muharam / Tahun Baru Hijriah"
            },
            "2023-08-17": {
                "summary": "Hari Proklamasi Kemerdekaan R.I."
            },
            "2023-09-28": {
                "summary": "Maulid Nabi Muhammad"
            },
            "2023-12-25": {
                "summary": "Hari Raya Natal"
            },
            "2023-12-26": {
                "summary": "Cuti Bersama Natal (Hari Tinju)"
            },
            "2024-01-01": {
                "summary": "Hari Tahun Baru"
            },
            "2024-02-08": {
                "summary": "Isra Mikraj Nabi Muhammad"
            },
            "2024-02-10": {
                "summary": "Tahun Baru Imlek"
            },
            "2024-03-11": {
                "summary": "Hari Suci Nyepi (Tahun Baru Saka)"
            },
            "2024-03-29": {
                "summary": "Wafat Isa Almasih"
            },
            "2024-04-10": {
                "summary": "Hari Idul Fitri"
            },
            "2024-04-11": {
                "summary": "Hari Idul Fitri"
            },
            "2024-05-01": {
                "summary": "Hari Buruh Internasional / Pekerja"
            },
            "2024-05-09": {
                "summary": "Kenaikan Isa Al Masih"
            },
            "2024-05-23": {
                "summary": "Hari Raya Waisak"
            },
            "2024-06-01": {
                "summary": "Hari Lahir Pancasila"
            },
            "2024-06-17": {
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
            "info": {
                "author": "guangrei",
                "link": "https://github.com/guangrei",
                "updated": "20230725 09:09:00"
            }
        }';
    }
}