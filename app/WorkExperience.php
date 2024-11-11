<?php

namespace App;

use Eloquent;

class WorkExperience extends Eloquent
{
    protected $table = 'work_experience';
    protected $fillable = [
        'user_id',
        'company_name',
        'start_date',
        'end_date',
        'department',
        'role',
        'experience_years'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
