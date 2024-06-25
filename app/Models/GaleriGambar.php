<?php

namespace App\Models;

use App\Models\Galeri;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriGambar extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function galeri()
    {
        return $this->belongsTo(Galeri::class);
    }
}
