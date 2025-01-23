<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kabkota extends Model
{
    use HasFactory;
    protected $table = 'kabkota';
    protected $fillable = ['name', 'alt_name', 'latitude', 'longitude', 'provinsi_id'];

    function provinsi(): BelongsTo {
        return $this->belongsTo(Provinsi::class);
    }
}
