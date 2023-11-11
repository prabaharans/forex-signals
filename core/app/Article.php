<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    protected $fillable = ['category_id','title','description'];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }
}
