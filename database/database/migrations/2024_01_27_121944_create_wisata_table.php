<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wisatas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_id')->constrained()->cascadeOnDelete();
            $table->string('nama_wisata');
            $table->string('lokasi_maps');
            $table->string('link_foto');
            $table->string('keterangan');
            $table->string('fasilitas');
            $table->integer('biaya');
            $table->string('situs');
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
        Schema::dropIfExists('wisatas');
    }
};
