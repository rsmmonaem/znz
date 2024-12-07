<?php

namespace App;

use Eloquent;

class SpacialHoliday extends Eloquent
{

    protected $fillable = [
        'date',
        'branch',
        'description'
    ];
    protected $primaryKey = 'id';
    protected $table = 'spacial_holidays';
}
