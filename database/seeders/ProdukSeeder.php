<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            \App\Models\Produk::factory()->create([
                'p_id' => $i,
                'p_nama' => "Produk {$i}",
                'p_gambar' => "produk-{$i}.jpg",
                'p_harga' => $i * 1000,
                'p_stok' => $i * 2,
                'p_deskripsi' => "Deskripsi Produk {$i}",
                'p_kategori' => "Kategori {$i}",
                'p_berat' => $i * 50,
                'penjual_p_id' => 1,
                'halal_status' => 'Halal',
            ]);
        }
    }
}
