<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $table = 'general_settings';

    protected $fillable =['title','color','logo','favicon','address','email','number','facebook','twitter','google_plus','linkedin','youtube','footer_text','footer_bottom_text','paypal_email','top_text'];
}
