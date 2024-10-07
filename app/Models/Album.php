<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{

    use HasFactory;

    protected $fillable = ['title', 'release_date', 'band_id', 'image'];

    public function band()
    {
        return $this->belongsTo(Band::class);
    }
}
