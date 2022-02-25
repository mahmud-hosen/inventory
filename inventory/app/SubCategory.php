<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubCategory extends Model
{
    use SoftDeletes;

     /* We want to relation subCategory with Category.
       Many subCategory has one Category . So needed to use belongsTo
       this model SubCategory So this SubCategory has one 'App\Category' .It is 1st parametre
        2nd parametre foreign_key  is   cat_id 
        3rd parametre SubCategory table id primary_key or local_key is  id

    */
    // Relation with Category & SubCategory  start
    public function categories()
    {
        return $this->belongsTo('App\Category','category_id','id');
    }
    // Relation with Category & SubCategory  end
   
    // Relation with Sub Category &  Product  start
    public function products()
    {
        return $this->hasMany('App\Product','sub_category_id','id');
    }
    // Relation with Sub Category & Product  end


   
    
}
