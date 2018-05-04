<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     protected $fillable = ['user_id', 'content', 'status'];

      public function posts()
    {
    	return $this->hasOne('App\posts');
    }
}
