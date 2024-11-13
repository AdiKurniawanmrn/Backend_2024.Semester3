<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Pegawai extends Model
{
    protected $fillable=[
        'nama','jenis_kelamin','no_hp','alamat','email','status','tanggal_masuk'
    ];
}
