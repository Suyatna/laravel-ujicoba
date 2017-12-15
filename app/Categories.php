<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table    = 'categories';
    protected $fillable = [
        'name', 'slug'
    ];

    public function post(){
        return $this->hasMany('App\Post', 'categories_id', 'id');
    }
}
