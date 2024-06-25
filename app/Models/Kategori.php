<?php

namespace App\Models;

use App\Models\Barang;
use App\Models\Galeri;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }

}
