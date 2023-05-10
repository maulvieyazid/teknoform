<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddJenisMerkTipeToKoleksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('koleksi', function (Blueprint $table) {
            $table->string('jenis')->nullable()->after('nama_koleksi');
            $table->string('merk')->nullable()->after('jenis');
            $table->string('tipe')->nullable()->after('merk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('koleksi', function (Blueprint $table) {
            //
        });
    }
}
