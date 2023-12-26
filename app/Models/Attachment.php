<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;
    protected $fillable = [
        'uuid',
        'user_id',
        'category_id',
        'item_id',
        'org_name',
        'unique_name',
        'path',
        'extension',
        'status'
    ];
}
