<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'postcode',
        'address',
        'phone',
        'profile_image',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * いいねした商品のリレーション
     */
    public function favorites(): HasMany
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * いいねした商品の ID を配列で取得
     */
    public function favoriteItemIds(): array
    {
        return $this->favorites()->pluck('item_id')->toArray();
    }

    /**
     * いいねした商品を取得（アイテムのリスト）
     */
    public function likedItems()
    {
        return $this->belongsToMany(Item::class, 'favorites', 'user_id', 'item_id');
    }
}
