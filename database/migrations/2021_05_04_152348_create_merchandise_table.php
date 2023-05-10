<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMerchandiseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('merchandise', function (Blueprint $table) {
            $table->increments('id_merchandise');
            $table->string('kode')->nullable();
            $table->string('nama_merchandise')->nullable();
            $table->string('harga')->nullable();
            $table->string('stok')->nullable();
            $table->string('ukuran')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('folder_merchandise')->nullable();
            $table->string('slug')->nullable();
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
        Schema::dropIfExists('merchandise');
    }
}
