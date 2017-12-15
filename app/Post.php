<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'category_id', 'user_id', 'title', 'slug', 'content',
    ];

    protected $table = 'posts';

    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }

    public function kategori(){
        return $this->belongsTo('App\Categories', 'categories_id');
    }

    public function comment()
    {
      return$this->hasMany('App\Comment');
    }


}
