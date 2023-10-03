<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    public $incrementing = false;
    
    protected $fillable = [
        'title',
        'body',
        'user_id'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function($post){
            $post->user_id = auth()->id();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
