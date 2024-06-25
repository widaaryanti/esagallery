<?php

namespace App\Models;

use App\Models\Kategori;
use App\Models\BarangGambar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function barangGambars()
    {

        return $this->hasMany(BarangGambar::class);
    }

}