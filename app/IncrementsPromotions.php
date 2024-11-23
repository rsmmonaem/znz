<?php

namespace App;
use Eloquent;

class IncrementsPromotions extends Eloquent
{
    protected $table = 'increments_promotions';

    protected $fillable = [
        'employee_id',
        'entry_date',
        'effective_date',
        'promotion',
        'increment',
        'category',
        'grade',
        'amount',
        'designation',
        'remark',
        'old_amount',
        'status',
        'approved_date'
    ];

    // Automatically manage timestamps
    public $timestamps = true;

    public function user() {
        return $this->belongsTo('App\User','employee_id');
    }
}