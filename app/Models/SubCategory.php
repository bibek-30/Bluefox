<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    // protected $table = 'subcategory';
  protected $fillable = [
    'id',
    'name',
    'slug',
    'category_id'
    // 'id_mastercategory'
   ];


//    public function category()
//  {
//   return $this->belongsTo('App\Category1');
//  } 


}
