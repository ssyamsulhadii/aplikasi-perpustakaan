<?php

use App\Models\Level;
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
            $table->char('telpon', 15)->after('password')->nullable();
            $table->char('alamat')->after('password')->nullable();
            $table->string('gambar')->after('password')->nullable();
            $table->foreignIdFor(Level::class, 'level_id')->constrained('level', 'id')->onDelete('cascade');
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
