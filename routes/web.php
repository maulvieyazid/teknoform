<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Monolog\Handler\RotatingFileHandler;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('360', 'HomeController@virtual_tour')->name('virtual_tour');
Route::get('entry-360', 'HomeController@entry_virtual_tour')->name('entry_virtual_tour');
Route::post('entry-360', 'HomeController@store_entry_virtual_tour')->name('store_entry_virtual_tour');

/* Route::get('file-buat', function () {
    // Storage::cloud()->put("1uDEwrHaPT7hniJrQdSaFTnHOJudEV1Zh/uji.pdf", '');
    Storage::cloud()->put("1rH_8DvHqzfvUF1QP1h55qebnzbNo5J5Z/uji.docx", '', [
        'mimetype' => 'application/vnd.google-apps.document'
    ]);
    echo "Hooraayyy";
}); */

/* Route::get('folder-buat', function () {
    $result = Storage::cloud()->listContents('1rH_8DvHqzfvUF1QP1h55qebnzbNo5J5Z');
    // Storage::cloud()->put("1rH_8DvHqzfvUF1QP1h55qebnzbNo5J5Z/uji.docx", '', [
    //     'mimetype' => 'application/vnd.google-apps.document'
    // ]);
    dd($result);
}); */

Route::get('file-liat', function () {
    $dir = '1ghugWMTtOWHxvMZdbKhr26HZWxpmeJsh';
    $recursive = false; // Get subdirectories also?
    $contents = collect(Storage::cloud()->listContents($dir, $recursive));

    // $contents = Storage::cloud()->getMimetype('1dZ_EkxJZJjw8V202hhDKVNPf8ldpLynq');
    // $contents = Storage::cloud()->getMetadata('13JSvmGIHPG7SEKaaUP6l8VU_Pi4jMHrJMluwxxLoSo8');
    // $contents = Storage::cloud()->url('13JSvmGIHPG7SEKaaUP6l8VU_Pi4jMHrJMluwxxLoSo8');
    dd($contents);

    return redirect('https://docs.google.com/document/d/13JSvmGIHPG7SEKaaUP6l8VU_Pi4jMHrJMluwxxLoSo8/edit');
});

/* Route::get('file-update', function () {
    $result = Storage::cloud()->update("13JSvmGIHPG7SEKaaUP6l8VU_Pi4jMHrJMluwxxLoSo8", 'coabacobaobcoab');
    return $result;
}); */


Auth::routes(['register' => false]);

/* Route::get('/lmoijadpkslemi', function () {
    $allCities = [];

    $provinceIds = [11, 51, 36, 17, 34, 31, 75, 15, 32, 33, 35, 61, 63, 62, 64, 65, 19, 21, 18, 81, 82, 52, 53, 92, 91, 14, 76, 73, 72, 74, 71, 13, 16, 12];

    // Loop melalui semua provinceId yang Anda tentukan
    foreach ($provinceIds as $provinceId) {
        // $provinceUrl = "https://emsifa.github.io/api-wilayah-indonesia/api/regencies/{$provinceId}.json";
        $provinceUrl = "http://api.iksgroup.co.id/apilokasi/kabupaten?provinsi={$provinceId}";

        // Melakukan permintaan API ke provinsi
        $provinceData = json_decode(file_get_contents($provinceUrl), true);

        // Mengambil data dari atribut "data" dan menggabungkannya dengan $allData
        if (isset($provinceData['data'])) {
            $allCities = array_merge($allCities, $provinceData['data']);
        }
    }

    $jsonData = json_encode($allCities, JSON_PRETTY_PRINT);


    file_put_contents('/atad/web-dinamika/teknoform/public/data_kota.json', $jsonData);

    echo "Data telah ditulis ke dalam file";
}); */
// Route::get('/info', function () {
//         return phpinfo();
//     });
Route::get('/', 'MuseumController@index');
Route::get('/booking-online', 'MuseumController@booking')->name('booking-online');
Route::post('/booking-online', 'MuseumController@tambah_booking')->name('tambah-booking');
Route::get('/donasi-koleksi', 'MuseumController@donasi')->name('donasi-koleksi');
Route::post('/donasi-koleksi', 'MuseumController@tambah_donasi')->name('tambah-donasi');
Route::get('/buku-tamu', 'MuseumController@buku_tamu')->name('buku-tamu');
Route::post('/buku-tamu', 'MuseumController@tambah_data_tamu')->name('tambah-tamu');
Route::post('/simpan-saran', 'MuseumController@simpan_saran')->name('tambah-saran');
Route::get('/katalog', 'MuseumController@merchandise')->name('katalog-merchandise');
Route::get('/katalog/{merchandise}', 'MuseumController@merchandise_produk')->name('produk-merchandise');
Route::get('/gallery/{kategori}', 'MuseumController@galeri')->name('gallery');
Route::get('/event', 'MuseumController@agenda')->name('event');
Route::get('/event/{agenda}', 'MuseumController@event_agenda')->name('event-agenda');
Route::get('/news/{berita}', 'MuseumController@berita')->name('berita');
Route::get('/ensiklopedia', 'MuseumController@ensiklopedia')->name('ensiklopedia');
Route::get('/ensiklopedia/{koleksi}', 'MuseumController@ensiklopedia_koleksi')->name('ensiklopedia-koleksi');
Route::get('show/file/{majalah}', 'MajalahController@showFile')->name('majalah.show.file');
Route::get('download/file/{majalah}', 'MajalahController@downloadFile')->name('majalah.download.file');

Route::middleware(['auth'])->group(function () {
    /** Home Route */
    Route::get('/home', 'HomeController@index')->name('home');

    /** Koleksi Route */
    Route::resource('koleksi', 'KoleksiController');

    /** Majalah Route */
    Route::resource('majalah', 'MajalahController');

    /** Galeri Route */
    Route::resource('galeri', 'GaleriController');

    /** Kategori Route */
    Route::resource('kategori', 'KategoriController');

    /** Agenda Route */
    Route::resource('agenda', 'AgendaController');

    /** Booking Route */
    Route::resource('booking', 'BookingController');

    /** Donasi Route */
    Route::resource('donasi', 'DonasiController');

    /** Merchandise Route */
    Route::resource('merchandise', 'MerchandiseController');

    /** Pengunjung Route */
    Route::resource('pengunjung', 'PengunjungController');

    /** Kritik Saran Route */
    Route::resource('kritiksaran', 'KritikSaranController');

    /** Berita Route */
    Route::resource('berita', 'BeritaController');
});
