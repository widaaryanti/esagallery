<?php

namespace App\Models;

use App\Models\GaleriGambar;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function galeriGambars()
    {
        return $this->hasMany(GaleriGambar::class);
    }

}
