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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip',12); //4 tahun_masuk, 2 bulan_masuk, '0', 2 kode_gol, 3 no_urut (total 12)
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('telp');
            $table->string('alamat');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['pria','wanita']);
            $table->string('agama');
            $table->boolean('status_nikah');
            $table->date('tahun_masuk');
            $table->string('jabatan');
            $table->unsignedBigInteger('golongan_id');
            $table->timestamps();

            $table->foreign('golongan_id')->references('id')->on('golongan')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawai');
    }
};
