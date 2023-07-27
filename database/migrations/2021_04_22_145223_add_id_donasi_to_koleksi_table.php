<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdDonasiToKoleksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('koleksi', function (Blueprint $table) {
            $table->unsignedInteger('id_donasi')->nullable()->after('foto');

            $table->foreign('id_donasi')->references('id_donasi')->on('donasi');

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
            $table->dropForeign(['id_donasi']);
        });
    }
}
