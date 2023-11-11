<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'services';

    protected $fillable = ['name','currency_id','price','description1','description2','description3','description4','description5','description6','description7','description8','description9','description10'];

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }
    public function signals()
    {
        return $this->belongsToMany('App\Signal');
    }
    public function member()
    {
        return $this->belongsTo('App\Member');
    }

}
