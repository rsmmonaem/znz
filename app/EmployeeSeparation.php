<?php

namespace App;

use Eloquent;

class EmployeeSeparation extends Eloquent
{
    
    protected $fillable = [
        'employee_id',
        'employee_name',
        'branch',
        'designation',
        'doj',
        'section',
        'separation_type',
        'reason',
        'entry_date',
        'separation_arise_date',
        'last_working_day',
        'effective_date',
        'notice_period',
        'mandatory_notice',
        'short_day',
    ];
    protected $primaryKey = 'id';
    protected $table = 'employee_separations';
}
