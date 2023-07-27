<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->increments('id_booking');
            $table->string('nama')->nullable();
            $table->string('email')->nullable();
            $table->string('telp')->nullable();
            $table->string('instansi')->nullable();
            $table->string('jumlah_peserta')->nullable();
            $table->timestamp('tanggal_kunjungan', 0)->nullable();
            $table->enum('status', ['tunggu','setuju', 'batal']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking');
    }
}
