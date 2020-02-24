<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    const FOUNDER = 1,
          DIRECTOR = 2,
          CTO = 3,
          TEAMLEAD = 4,
          DEVELOPER = 5;

    public function getPositionIds() : array
    {
        return [
            self::FOUNDER,
            self::DIRECTOR,
            self::CTO,
            self::TEAMLEAD,
            self::DEVELOPER,
        ];
    }
}
