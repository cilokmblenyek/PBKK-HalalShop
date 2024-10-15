<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasFactory;

    protected $table = 'produks';
    protected $primaryKey = 'p_id';
    public $incrementing = false;  // Assuming your IDs are not auto-incrementing
    protected $keyType = 'string'; // If your IDs are strings and not integers

    protected $fillable = [
        'p_id',
        'p_nama',
        'p_gambar',
        'p_harga',
        'p_stok',
        'p_deskripsi',
        'p_kategori',
        'p_berat',
        'penjual_p_id',
    ];

    public function scopeFilter($query, array $filters)
    {
        if (!empty($filters['search'])) {
            $query->where(function ($query) use ($filters) {
                $search = $filters['search'];
                $query->where('p_nama', 'like', "%{$search}%")
                    ->orWhere('p_kategori', 'like', "%{$search}%");
            });
        }
    }
}
