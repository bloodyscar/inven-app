<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';

    protected $fillable = [
        'name',
        'category_id',
        'lokasi',
        'quantity',
        'description',
        'penerima',
        'satuan',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}
