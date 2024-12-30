<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PT extends Model 
{

    protected $table = 'product_tag';
    public $timestamps = true;
    protected $fillable = array('product_id', 'tag_id');

}