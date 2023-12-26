<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'item_key',
        'category_id',
        'user_id',
        'price',
        'description',
        'user_name',
        'phone',
        'address'
    ];
    protected $with = [
        'item_photo','category'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public static function booted(): void
    {
        static::creating(function ($model) {
            $model->item_key = Str::uuid();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function item_photo(): HasMany
    {
        return $this->hasMany(Attachment::class)->where('status', 'item_photo');
    }
}
