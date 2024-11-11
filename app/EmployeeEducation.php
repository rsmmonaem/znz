<?php

namespace App;

use Eloquent;

class EmployeeEducation extends Eloquent
{
    protected $table = 'education';
    protected $fillable = [
        'education_level',
        'subject',
        'board',
        'institute',
        'result_type',
        'grade',
        'passing_year',
        'user_id',
    ];
    protected $primaryKey = 'id';
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
