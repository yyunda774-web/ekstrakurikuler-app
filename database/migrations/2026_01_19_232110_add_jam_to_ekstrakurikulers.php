<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('ekstrakurikulers', function (Blueprint $table) {
            if (!Schema::hasColumn('ekstrakurikulers', 'jam')) {
                $table->string('jam')->nullable()->after('hari');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ekstrakurikulers', function (Blueprint $table) {
            if (Schema::hasColumn('ekstrakurikulers', 'jam')) {
                $table->dropColumn('jam');
            }
        });
    }
};