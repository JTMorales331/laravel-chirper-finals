<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bookmark extends Model
{
    protected $fillable = ['user_id', 'chirp_id'];

    public function chirp():BelongsTo
    {
        return $this->belongsTo(Chirp::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
