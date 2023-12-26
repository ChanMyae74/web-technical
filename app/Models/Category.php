<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'category_key',
        'user_id',
        'is_publish'
    ];
    protected $with = [
        'category_photo',
    ];

    public static function booted(): void
    {
        static::creating(function ($model) {
            $model->category_key = Str::uuid();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function category_photo(): HasMany
    {
        return $this->hasMany(Attachment::class)->where('status', 'category_photo');
    }

}
