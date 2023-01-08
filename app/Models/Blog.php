<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\category;

class Blog extends Model
{
    use HasFactory;
    protected $table = 'blog';
    protected $fillable = ['id', 'title', 'slug', 'description', 'category_id', 'image', 'status'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id');
    }


    
}
