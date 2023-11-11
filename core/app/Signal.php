<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signal extends Model
{
    protected $table = 'signals';

    protected $fillable = ['title','description'];

    public function services()
    {
        return $this->belongsToMany('App\Service');
    }


}
