<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengembalianbukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengembalianbuku', function (Blueprint $table) {
            $table->char('kode', 7); //PGN
            $table->unsignedBigInteger('peminjamanbuku_id');
            $table->foreign('peminjamanbuku_id')->references('id')->on('peminjamanbuku')->onDelete('cascade');
            $table->date('tanggal_kembali')->nullable();
            $table->date('tanggal_kembali_over')->nullable();
            $table->string('denda')->nullable();
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
        Schema::dropIfExists('pengembalianbuku');
    }
}
