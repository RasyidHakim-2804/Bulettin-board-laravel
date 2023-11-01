<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $keyType    = 'string';
    public $incrementing  = false;

    protected $fillable = ['body', 'post_id'];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($comment) {
            $comment->user_id = auth()->id();
            $comment->id = 'comment-' . strval(auth()->id()) . "-" . now()->format('Y-m-d H:i:s');
        });
    }


    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
