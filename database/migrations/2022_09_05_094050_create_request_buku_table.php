<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_buku', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 30);
            $table->string('sampul')->nullable();
            $table->string('penulis', 20);
            $table->string('penerbit', 20);
            $table->text('keterangan');
            $table->char('status', 1)->default(false);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('request_buku');
    }
}
