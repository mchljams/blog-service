<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    public function path()
    {
        return $this->morphTo();
    }

    /**
     * Get the file's user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
