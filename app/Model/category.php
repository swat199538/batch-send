<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $table = 'as_category';

    public function getSmsTempleById($id)
    {
        return parent::find($id);
    }

}
