<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama Pegawai
            $table->char('gender', 1); // Jenis Kelamin (L / P)
            $table->string('phone'); // No HP Pegawai
            $table->text('address')->nullable(); // Alamat Pegawai, nullable jika tidak diisi
            $table->string('email')->unique(); // Email Pegawai
            $table->string('status'); // Status Pegawai
            $table->date('hired_on'); // Tanggal Masuk Kerja
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
}
