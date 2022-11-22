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
        Schema::create('penggajian', function (Blueprint $table) {
            $table->id();
            $table->string('no_slip');
            $table->dateTime('tanggal');
            $table->unsignedBigInteger('pegawai_id');
            $table->integer('jml_lembur');
            $table->integer('jml_cuti');
            $table->float('gaji_pokok',10,2);
            $table->float('gaji_lembur',10,2);
            $table->float('ppn');
            $table->float('total_gaji',10,2);
            $table->timestamps();

            $table->foreign('pegawai_id')->references('id')->on('pegawai')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penggajian');
    }
};
