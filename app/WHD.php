<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class WHD extends Model
{
    protected $table = 'whd';
    protected $fillable = [
        'id','user_id','date'
    ];
    public $timestamps = false;
}