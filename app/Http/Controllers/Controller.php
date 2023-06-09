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
        // $source = file_get_contents("https://github.com/guangrei/Json-Indonesia-holidays/raw/master/calendar.json");
        $source = $this->hariLiburIndonesia();
        $data = collect(json_decode($source, true))
            ->keys()
            ->slice(0, -1)
            ->map(function ($item) {
                $y = new DateTime($item);
                return $y->format('Y-m-d');
            });
        return $data;
    }

    protected function hariLiburIndonesia()
    {
        return '{
            "20210101": {
                "deskripsi": "Hari Tahun Baru",
                "dibuat": "20210826T115903Z",
                "dimodifikasi": "20210826T115903Z",
                "status": "CONFIRMED"
            },
            "20210212": {
                "deskripsi": "Tahun Baru Imlek",
                "dibuat": "20210826T115932Z",
                "dimodifikasi": "20210826T115932Z",
                "status": "CONFIRMED"
            },
            "20210311": {
                "deskripsi": "Isra Mikraj Nabi Muhammad",
                "dibuat": "20210826T115927Z",
                "dimodifikasi": "20210826T115927Z",
                "status": "CONFIRMED"
            },
            "20210312": {
                "deskripsi": "Cuti Bersama",
                "dibuat": "20210826T115907Z",
                "dimodifikasi": "20210826T115907Z",
                "status": "CONFIRMED"
            },
            "20210314": {
                "deskripsi": "Hari Suci Nyepi (Tahun Baru Saka)",
                "dibuat": "20210826T115917Z",
                "dimodifikasi": "20210826T115917Z",
                "status": "CONFIRMED"
            },
            "20210402": {
                "deskripsi": "Wafat Isa Almasih",
                "dibuat": "20210826T115917Z",
                "dimodifikasi": "20210826T115917Z",
                "status": "CONFIRMED"
            },
            "20210404": {
                "deskripsi": "Hari Paskah",
                "dibuat": "20210826T115932Z",
                "dimodifikasi": "20210826T115932Z",
                "status": "CONFIRMED"
            },
            "20210421": {
                "deskripsi": "Hari Kartini",
                "dibuat": "20210826T115927Z",
                "dimodifikasi": "20210826T115927Z",
                "status": "CONFIRMED"
            },
            "20210501": {
                "deskripsi": "Hari Buruh Internasional / Pekerja",
                "dibuat": "20210826T115917Z",
                "dimodifikasi": "20210826T115917Z",
                "status": "CONFIRMED"
            },
            "20210512": {
                "deskripsi": "Cuti Bersama Idul Fitri",
                "dibuat": "20210826T115903Z",
                "dimodifikasi": "20210826T115903Z",
                "status": "CONFIRMED"
            },
            "20210513": {
                "deskripsi": "Hari Idul Fitri",
                "dibuat": "20210826T115927Z",
                "dimodifikasi": "20210826T115927Z",
                "status": "CONFIRMED"
            },
            "20210514": {
                "deskripsi": "Hari Idul Fitri",
                "dibuat": "20210826T115903Z",
                "dimodifikasi": "20210826T115903Z",
                "status": "CONFIRMED"
            },
            "20210517": {
                "deskripsi": "Cuti Bersama Idul Fitri",
                "dibuat": "20210826T115907Z",
                "dimodifikasi": "20210826T115907Z",
                "status": "CONFIRMED"
            },
            "20210518": {
                "deskripsi": "Cuti Bersama Idul Fitri",
                "dibuat": "20210826T115907Z",
                "dimodifikasi": "20210826T115907Z",
                "status": "CONFIRMED"
            },
            "20210519": {
                "deskripsi": "Cuti Bersama Idul Fitri",
                "dibuat": "20210826T115903Z",
                "dimodifikasi": "20210826T115903Z",
                "status": "CONFIRMED"
            },
            "20210526": {
                "deskripsi": "Hari Raya Waisak",
                "dibuat": "20210826T115927Z",
                "dimodifikasi": "20210826T115927Z",
                "status": "CONFIRMED"
            },
            "20210601": {
                "deskripsi": "Hari Lahir Pancasila",
                "dibuat": "20210826T115907Z",
                "dimodifikasi": "20210826T115907Z",
                "status": "CONFIRMED"
            },
            "20210720": {
                "deskripsi": "Idul Adha (Lebaran Haji)",
                "dibuat": "20210826T115903Z",
                "dimodifikasi": "20210826T115903Z",
                "status": "CONFIRMED"
            },
            "20210810": {
                "deskripsi": "Satu Muharam / Tahun Baru Hijriah",
                "dibuat": "20210826T115903Z",
                "dimodifikasi": "20210826T115903Z",
                "status": "CONFIRMED"
            },
            "20210811": {
                "deskripsi": "Satu Muharam / Tahun Baru Hijriah",
                "dibuat": "20210826T115917Z",
                "dimodifikasi": "20210826T115917Z",
                "status": "CONFIRMED"
            },
            "20210817": {
                "deskripsi": "Hari Proklamasi Kemerdekaan R.I.",
                "dibuat": "20210826T115917Z",
                "dimodifikasi": "20210826T115917Z",
                "status": "CONFIRMED"
            },
            "20211002": {
                "deskripsi": "Hari Batik",
                "dibuat": "20210826T115903Z",
                "dimodifikasi": "20210826T115903Z",
                "status": "CONFIRMED"
            },
            "20211019": {
                "deskripsi": "Maulid Nabi Muhammad",
                "dibuat": "20211016T083034Z",
                "dimodifikasi": "20211016T083034Z",
                "status": "CONFIRMED"
            },
            "20211020": {
                "deskripsi": "Maulid Nabi Muhammad",
                "dibuat": "20210826T115907Z",
                "dimodifikasi": "20210826T115907Z",
                "status": "CONFIRMED"
            },
            "20211104": {
                "deskripsi": "Diwali / Deepavali",
                "dibuat": "20210826T115903Z",
                "dimodifikasi": "20210826T115903Z",
                "status": "CONFIRMED"
            },
            "20211112": {
                "deskripsi": "Hari Ayah",
                "dibuat": "20210826T115917Z",
                "dimodifikasi": "20210826T115917Z",
                "status": "CONFIRMED"
            },
            "20211125": {
                "deskripsi": "Hari Guru",
                "dibuat": "20210826T115903Z",
                "dimodifikasi": "20210826T115903Z",
                "status": "CONFIRMED"
            },
            "20211222": {
                "deskripsi": "Hari Ibu",
                "dibuat": "20210826T115903Z",
                "dimodifikasi": "20210826T115903Z",
                "status": "CONFIRMED"
            },
            "20211224": {
                "deskripsi": "Malam Natal",
                "dibuat": "20210826T115927Z",
                "dimodifikasi": "20210826T115927Z",
                "status": "CONFIRMED"
            },
            "20211225": {
                "deskripsi": "Hari Raya Natal",
                "dibuat": "20210826T115927Z",
                "dimodifikasi": "20210826T115927Z",
                "status": "CONFIRMED"
            },
            "20211227": {
                "deskripsi": "Cuti Bersama Natal (Hari Tinju)",
                "dibuat": "20210826T115917Z",
                "dimodifikasi": "20210826T115917Z",
                "status": "CONFIRMED"
            },
            "20211231": {
                "deskripsi": "Malam Tahun Baru",
                "dibuat": "20210826T115903Z",
                "dimodifikasi": "20210826T115903Z",
                "status": "CONFIRMED"
            },
            "20220101": {
                "deskripsi": "Hari Tahun Baru",
                "dibuat": "20210826T115917Z",
                "dimodifikasi": "20210826T115917Z",
                "status": "CONFIRMED"
            },
            "20220201": {
                "deskripsi": "Tahun Baru Imlek",
                "dibuat": "20210826T115907Z",
                "dimodifikasi": "20210826T115907Z",
                "status": "CONFIRMED"
            },
            "20220228": {
                "deskripsi": "Isra Mikraj Nabi Muhammad",
                "dibuat": "20211002T072614Z",
                "dimodifikasi": "20211002T072614Z",
                "status": "CONFIRMED"
            },
            "20220303": {
                "deskripsi": "Hari Suci Nyepi (Tahun Baru Saka)",
                "dibuat": "20211002T072614Z",
                "dimodifikasi": "20211002T072614Z",
                "status": "CONFIRMED"
            },
            "20220415": {
                "deskripsi": "Wafat Isa Almasih",
                "dibuat": "20210826T115927Z",
                "dimodifikasi": "20210826T115927Z",
                "status": "CONFIRMED"
            },
            "20220417": {
                "deskripsi": "Hari Paskah",
                "dibuat": "20210826T115907Z",
                "dimodifikasi": "20210826T115907Z",
                "status": "CONFIRMED"
            },
            "20220421": {
                "deskripsi": "Hari Kartini",
                "dibuat": "20210826T115903Z",
                "dimodifikasi": "20210826T115903Z",
                "status": "CONFIRMED"
            },
            "20220429": {
                "deskripsi": "Cuti Bersama Idul Fitri",
                "dibuat": "20220514T084037Z",
                "dimodifikasi": "20220514T084037Z",
                "status": "CONFIRMED"
            },
            "20220501": {
                "deskripsi": "Hari Buruh Internasional / Pekerja",
                "dibuat": "20210826T115917Z",
                "dimodifikasi": "20210826T115917Z",
                "status": "CONFIRMED"
            },
            "20220502": {
                "deskripsi": "Hari Idul Fitri",
                "dibuat": "20211002T072614Z",
                "dimodifikasi": "20211002T072614Z",
                "status": "CONFIRMED"
            },
            "20220503": {
                "deskripsi": "Hari Idul Fitri",
                "dibuat": "20210826T115917Z",
                "dimodifikasi": "20210826T115917Z",
                "status": "CONFIRMED"
            },
            "20220504": {
                "deskripsi": "Cuti Bersama Idul Fitri",
                "dibuat": "20220514T084037Z",
                "dimodifikasi": "20220514T084037Z",
                "status": "CONFIRMED"
            },
            "20220505": {
                "deskripsi": "Cuti Bersama Idul Fitri",
                "dibuat": "20220514T084037Z",
                "dimodifikasi": "20220514T084037Z",
                "status": "CONFIRMED"
            },
            "20220506": {
                "deskripsi": "Cuti Bersama Idul Fitri",
                "dibuat": "20220514T084037Z",
                "dimodifikasi": "20220514T084037Z",
                "status": "CONFIRMED"
            },
            "20220516": {
                "deskripsi": "Hari Raya Waisak",
                "dibuat": "20211002T072614Z",
                "dimodifikasi": "20211002T072614Z",
                "status": "CONFIRMED"
            },
            "20220526": {
                "deskripsi": "Kenaikan Isa Al Masih",
                "dibuat": "20210826T115907Z",
                "dimodifikasi": "20210826T115907Z",
                "status": "CONFIRMED"
            },
            "20220601": {
                "deskripsi": "Hari Lahir Pancasila",
                "dibuat": "20210826T115907Z",
                "dimodifikasi": "20210826T115907Z",
                "status": "CONFIRMED"
            },
            "20220709": {
                "deskripsi": "Idul Adha (Lebaran Haji)",
                "dibuat": "20211002T072614Z",
                "dimodifikasi": "20211002T072614Z",
                "status": "CONFIRMED"
            },
            "20220730": {
                "deskripsi": "Satu Muharam / Tahun Baru Hijriah",
                "dibuat": "20210826T115903Z",
                "dimodifikasi": "20210826T115903Z",
                "status": "CONFIRMED"
            },
            "20220817": {
                "deskripsi": "Hari Proklamasi Kemerdekaan R.I.",
                "dibuat": "20210826T115917Z",
                "dimodifikasi": "20210826T115917Z",
                "status": "CONFIRMED"
            },
            "20221002": {
                "deskripsi": "Hari Batik",
                "dibuat": "20210826T115917Z",
                "dimodifikasi": "20210826T115917Z",
                "status": "CONFIRMED"
            },
            "20221008": {
                "deskripsi": "Maulid Nabi Muhammad",
                "dibuat": "20210826T115903Z",
                "dimodifikasi": "20210826T115903Z",
                "status": "CONFIRMED"
            },
            "20221024": {
                "deskripsi": "Diwali / Deepavali",
                "dibuat": "20210826T115917Z",
                "dimodifikasi": "20210826T115917Z",
                "status": "CONFIRMED"
            },
            "20221112": {
                "deskripsi": "Hari Ayah",
                "dibuat": "20210826T115907Z",
                "dimodifikasi": "20210826T115907Z",
                "status": "CONFIRMED"
            },
            "20221125": {
                "deskripsi": "Hari Guru",
                "dibuat": "20210826T115907Z",
                "dimodifikasi": "20210826T115907Z",
                "status": "CONFIRMED"
            },
            "20221222": {
                "deskripsi": "Hari Ibu",
                "dibuat": "20210826T115903Z",
                "dimodifikasi": "20210826T115903Z",
                "status": "CONFIRMED"
            },
            "20221224": {
                "deskripsi": "Malam Natal",
                "dibuat": "20210826T115927Z",
                "dimodifikasi": "20210826T115927Z",
                "status": "CONFIRMED"
            },
            "20221225": {
                "deskripsi": "Hari Raya Natal",
                "dibuat": "20210826T115927Z",
                "dimodifikasi": "20210826T115927Z",
                "status": "CONFIRMED"
            },
            "20221231": {
                "deskripsi": "Malam Tahun Baru",
                "dibuat": "20210826T115917Z",
                "dimodifikasi": "20210826T115917Z",
                "status": "CONFIRMED"
            },
            "20230421": {
                "deskripsi": "Hari Kartini",
                "dibuat": "20210826T115927Z",
                "dimodifikasi": "20210826T115927Z",
                "status": "CONFIRMED"
            },
            "20231002": {
                "deskripsi": "Hari Batik",
                "dibuat": "20210826T115903Z",
                "dimodifikasi": "20210826T115903Z",
                "status": "CONFIRMED"
            },
            "20231112": {
                "deskripsi": "Hari Ayah",
                "dibuat": "20210826T115927Z",
                "dimodifikasi": "20210826T115927Z",
                "status": "CONFIRMED"
            },
            "20231125": {
                "deskripsi": "Hari Guru",
                "dibuat": "20210826T115927Z",
                "dimodifikasi": "20210826T115927Z",
                "status": "CONFIRMED"
            },
            "20231222": {
                "deskripsi": "Hari Ibu",
                "dibuat": "20210826T115903Z",
                "dimodifikasi": "20210826T115903Z",
                "status": "CONFIRMED"
            },
            "created-at": "2022-05-16 04:01"
        }';
    }
}
