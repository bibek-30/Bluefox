<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'subling';

    protected $fillable = [
    'id',
    'name',
    'price',
    'desc',
    'image',
    'id_subcategory'
    ];
    public function category()
    {
   return $this->belongsTo('App\Category1');
    }
}
