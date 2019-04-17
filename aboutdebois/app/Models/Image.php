<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    //
    protected $fillable = [
        "name", "description", "category_id", "published"
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}