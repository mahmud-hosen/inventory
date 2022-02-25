<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    // Relation with Category & Content  start
    public function categories()
    {
        return $this->belongsTo('App\Category','category_id','id');
    }
     // Relation with Category & Content  end

    // Relation with SubCategory &  Content  start
    public function sub_categories()
    {
        return $this->belongsTo('App\SubCategory','sub_category_id','id');
    }
    // Relation with SubCategory &  Content  end
}
