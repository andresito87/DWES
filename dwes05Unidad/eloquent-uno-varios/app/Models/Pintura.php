<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pintura extends Model
{
    use HasFactory;

    public function pintor(): BelongsTo
    {
        return $this->belongsTo(Pintor::class);
    }
}
