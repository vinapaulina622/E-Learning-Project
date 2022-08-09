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
        Schema::create('absen', function (Blueprint $table) {
            $table->id();
            $table->timestamp('waktu_absen');
            $table->foreignId('mahasiswa_id')->constrained('mahasiswa')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('matakuliah_id')->constrained('matakuliah')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('keterangan', ['hadir', 'tidak hadir']);
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
        Schema::dropIfExists('absen');
    }
};
