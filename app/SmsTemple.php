<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SmsTemple extends Model
{
    protected $table = 'bao_sms_temple';

    protected $fillable = [
        'category','content',
    ];

    public function getTempleByCategory($category=1)
    {
        return parent::where('category', '=', $category)->get();
    }

}
