<?php

namespace App;

use Eloquent;

class SalaryAdvance extends Eloquent
{

    protected $fillable = ['employeeId', 'date', 'effectiveDate', 'month', 'grossOption', 'grossValue'];

    protected $primaryKey = 'id';
    protected $table = 'salary_advance';
    protected $casts = [
        'month' => 'array', // Automatically handle JSON to Array conversion
    ];
}
