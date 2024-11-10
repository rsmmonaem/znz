<?php
namespace App;
use Eloquent;

class Grade extends Eloquent {

	protected $fillable = [
							'id',
							'name',
                            'description',
						];
	protected $primaryKey = 'id';
	protected $table = 'grades';

}
