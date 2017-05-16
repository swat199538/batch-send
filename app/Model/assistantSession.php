<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class assistantSession extends Model
{
    protected $table = 'as_assistant_session';

    public function getIdBySession($session)
    {
        return parent::where('session', $session)->first();
    }

}
