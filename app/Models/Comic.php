<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    use HasFactory;
    protected $table = 'comics';
    protected $fillable = [
        'name',
        'status',
        'image',
        'views',
        'author_id',
        'category_id'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}
