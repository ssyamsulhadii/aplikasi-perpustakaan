<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCulumnDataToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->string('nama')->after('id');
            $table->char('level')->after('email')->default('anggota');
            $table->char('telpon', 15)->after('password')->nullable()->default(null);
            $table->char('alamat')->after('password')->nullable()->default(null);
            $table->string('gambar')->after('password')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name');
            $table->dropColumn('nama');
            $table->dropColumn('level');
            $table->dropColumn('telpon');
            $table->dropColumn('alamat');
            $table->dropColumn('gambar');
        });
    }
}
