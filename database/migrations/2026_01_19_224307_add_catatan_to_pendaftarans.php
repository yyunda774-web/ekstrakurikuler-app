<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCatatanToPendaftarans extends Migration
{
    public function up()
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
    if (!Schema::hasColumn('pendaftarans', 'catatan')) {
        $table->text('catatan')->nullable()->after('status');
    }
});
    }

    public function down()
    {
        Schema::table('pendaftarans', function (Blueprint $table) {
            $table->dropColumn('catatan');
        });
    }
}