<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToEkstrakurikulers extends Migration
{
    public function up()
    {
       Schema::table('ekstrakurikulers', function (Blueprint $table) {
    if (!Schema::hasColumn('ekstrakurikulers', 'deskripsi')) {
        $table->text('deskripsi')->nullable()->after('nama');
    }
});
    }

    public function down()
    {
        Schema::table('ekstrakurikulers', function (Blueprint $table) {
            $table->dropColumn(['deskripsi', 'pembina', 'kuota', 'hari', 'jam']);
        });
    }
}