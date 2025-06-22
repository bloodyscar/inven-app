<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    public function category()
    {
        return $this->hasMany(Item::class, 'category_id');
    }
}
