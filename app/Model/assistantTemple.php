<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class assistantTemple extends Model
{
    protected $table = 'as_assistant_temple';

    public function getTempleById($id)
    {
        return parent::find($id);
    }

}
