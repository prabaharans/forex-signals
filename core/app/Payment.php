<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table  = 'payments';

    protected $fillable = ['member_id','start_date','expiry_date'];

    public function member()
    {
        return $this->belongsTo(Member::class,'member_id');
    }
}
