<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('calons', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('nm_calon','100');
            $table->string('foto_calon');
            $table->unsignedBigInteger('kelas_id');
            $table->foreign('kelas_id')->references('id')->on('kelas')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('jurusans_id');
            $table->foreign('jurusans_id')->references('id')->on('jurusan')->onUpdate('cascade')->onDelete('restrict');
            $table->text('visi');
            $table->text('misi');
            $table->date('data_tahun');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calons');
    }
};
