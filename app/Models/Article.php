<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    // Разрешаем заполнять эти поля
    protected $fillable = [
        'title', 'short_description', 'content', 
        'preview_image', 'full_image', 'published_at'
    ];
}