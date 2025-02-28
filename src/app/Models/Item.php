<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category', 'description', 'price', 'image', 'user_id'];

    // 🔹 商品を出品したユーザー（出品者）
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // 🔹 商品に紐づくコメント
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
