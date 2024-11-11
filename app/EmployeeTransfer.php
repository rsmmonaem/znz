<?php

namespace App;

use Eloquent;

class EmployeeTransfer extends Eloquent
{
    protected $table = 'employeetransfer';
    protected $fillable = [
        'fbranch',
        'fdepartment',
        'fsection',
        'fdesignation',
        'ftransfer_date',
        'femployee',
        'tbranch',
        'tdepartment',
        'tsection',
        'tdesignation',
        'tjoin_date',
        'remarks'
    ];
    protected $primaryKey = 'id';
}
