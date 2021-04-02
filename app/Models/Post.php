<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Tag;
use App\Models\File;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'body',
        'file_id'
    ];

    /**
     * Get the post's user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the post's tags
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Get the post's main image.
     */
    public function main_image()
    {
        return $this->morphOne(File::class, 'path');
    }
}
