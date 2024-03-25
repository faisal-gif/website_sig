<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kerjasama', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prodi');
            $table->foreign('prodi')->references('id')->on('prodi')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('dudi_id');
            $table->foreign('dudi_id')->references('id')->on('dudi')->onUpdate('cascade')->onDelete('cascade');
            $table->string('bidang_kerjasama');
            $table->string('nama_pks');
            $table->string('no_pks');
            $table->date('mulai_pks');
            $table->date('penetapan_pks');
            $table->date('selesai_pks');
            $table->string('dokumen_pks');
            $table->string('dokumen_mou');
            $table->enum('status', ['berjalan', 'selesai']);
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
        Schema::dropIfExists('kejasamas');
    }
};
