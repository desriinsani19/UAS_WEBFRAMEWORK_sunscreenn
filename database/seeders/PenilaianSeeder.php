<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Penilaian;

class PenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'produk_sunscreen' => 'Wardah',
                'harga' => 65000,
                'kemasan' => 4,
                'kandungan' => 5,
                'ketahanan' => 4,
                'usia' => 'Remaja 15-25 tahun'
            ],
            [
                'produk_sunscreen' => 'Skintific',
                'harga' => 125000,
                'kemasan' => 5,
                'kandungan' => 5,
                'ketahanan' => 5,
                'usia' => 'Dewasa 20-35 tahun'
            ],
            [
                'produk_sunscreen' => 'Emina',
                'harga' => 45000,
                'kemasan' => 3,
                'kandungan' => 4,
                'ketahanan' => 3,
                'usia' => 'Remaja 13-22 tahun'
            ],
            [
                'produk_sunscreen' => 'The Originote',
                'harga' => 89000,
                'kemasan' => 4,
                'kandungan' => 5,
                'ketahanan' => 4,
                'usia' => 'Semua usia'
            ],
            [
                'produk_sunscreen' => 'G2G',
                'harga' => 55000,
                'kemasan' => 3,
                'kandungan' => 4,
                'ketahanan' => 3,
                'usia' => '18-30 tahun'
            ],
        ];

        foreach ($data as $item) {
            Penilaian::create($item);
        }
    }
}