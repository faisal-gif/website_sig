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
        Schema::create('dudi', function (Blueprint $table) {
            $table->id();
            $table->string('nib')->nullable();
            $table->string('tipe')->nullable();
            $table->string('kode_pt')->nullable();
            $table->string('jenis');
            $table->string('nama');
            $table->string('kategori_mitra');
            $table->string('lingkup_kerjasama');
            $table->string('email');
            $table->string('no_telp');
            $table->string('sk_pendirian')->nullable();
            $table->string('kbli')->nullable();
            $table->string('alamat');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('kecamatan');
            $table->string('kelurahan');
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
        //
    }
};
