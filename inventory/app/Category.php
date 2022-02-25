<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    /* We want to relation Category with subCategory.
       One Category has many subCategory .
       this model Category So this Category has many 'App\SubCategory' .It is 1st parametre
        2nd parametre foreign_key is               category_id 
        3rd parametre primary_key or localK_key is  id

    */
    // Relation with Category & SubCategory  start
    public function subCategories()
    {
        return $this->hasMany('App\SubCategory','category_id','id');
    }
    // Relation with Category & SubCategory  end

     // Relation with Category &  Product  start
    public function products()
    {
        return $this->hasMany('App\Product','category_id','id');
    }
    // Relation with Category & Product  end


    
}
