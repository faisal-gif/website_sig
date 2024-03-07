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
            $table->string('nama');
            $table->string('kategori_mitra');
            $table->string('lingkup_kerjasama');
            $table->string('email');
            $table->string('no_telp');
            $table->string('sk_pendirian')->nullable();
            $table->string('kbli')->nullable();
            $table->string('alamat');
            $table->unsignedBigInteger('provinsi');
            $table->unsignedBigInteger('kota');
            $table->unsignedBigInteger('kecamatan');
            $table->unsignedBigInteger('kelurahan');
            $table->timestamps();

            $table->foreign('provinsi')
                ->references('id')
                ->on(config('laravolt.indonesia.table_prefix') . 'provinces')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kota')
                ->references('id')
                ->on(config('laravolt.indonesia.table_prefix') . 'cities')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kecamatan')
                ->references('id')
                ->on(config('laravolt.indonesia.table_prefix') . 'districts')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->foreign('kelurahan')
                ->references('id')
                ->on(config('laravolt.indonesia.table_prefix') . 'villages')
                ->onUpdate('cascade')->onDelete('restrict');

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
