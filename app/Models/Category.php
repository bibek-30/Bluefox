<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // protected $table = 'mastercategory';
    protected $fillable = [
        'name',
        // 'slug',
        'parent_id'        
    ];


    // public function subcategory()
    // {
    //     return $this->hasMany(\App\Models\Category::class, 'parent_id');
    // }

    // public function parent()
    // {
    //     return $this->belongsTo(\App\Models\Category::class, 'parent_id');
    // }
    

    // public function childs()
    // {
    // 	return $this->hasMany(Category::class, 'parent_id');
    // }

    // public function parent()
    // {
    // 	return $this->belongsTo(Category::class, 'parent_id');
    // }


    


    // public static function tree(){
    //     $allCategories =  Category::get();
    //     $rootCategories = $allCategories->whereNull('parent_id');

    //     self::formatTree($rootCategories,$allCategories);
        
    //     return $rootCategories;
    // }

    // private static function formatTree($categories, $allCategories){
        
    //     foreach ($categories as $category) {
    //         $category ->children = $allCategories-> where('parent_id',$category->id)->values();

    //         self::formatTree($category->chldren,$allCategories);
    //     }
    // }


    

    // public function subcategories(){ 

    //     return $this->hasMany('App\Subcategory', 'id_mastercategory');
    //      }    
    // public function products()
    // {
    // return $this->hasMany('App\product1', 'id_subcategory');}




    // working part
    public function scopeRoot($query){
        $query-> whereNull('parent_id');
    }

    public function children(){
        return $this ->hasMany(Category::class,'parent_id'
    );

    }
}