// database/migrations/2024_01_20_create_pendaftarans_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaransTable extends Migration
{
    public function up()
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
    $table->id();
    $table->string('nama');
    $table->string('kelas');
    $table->string('no_hp');
    $table->string('kode_pendaftaran')->unique();
    $table->string('status')->default('pending');
    
    // Pastikan ada kolom user_id yang nullable
    $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
    $table->foreignId('ekstrakurikuler_id')->constrained('ekstrakurikulers')->onDelete('cascade');
    
    $table->timestamps();
});
    }

    public function down()
    {
        Schema::dropIfExists('pendaftarans');
    }
}