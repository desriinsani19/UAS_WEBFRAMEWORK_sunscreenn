<?php
// app/Models/Penilaian.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaian';

    protected $fillable = [
        'produk_sunscreen',
        'harga',
        'kemasan',
        'kandungan',
        'ketahanan',
        'usia'
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'kemasan' => 'integer',
        'kandungan' => 'integer',
        'ketahanan' => 'integer'
    ];
}