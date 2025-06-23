<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
     use HasFactory;
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
