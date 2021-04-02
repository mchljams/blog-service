<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Tag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id',
        'name'
    ];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

    /**
     * Get the tag's user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
