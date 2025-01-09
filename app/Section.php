<?php
namespace App;
use Eloquent;

class Section extends Eloquent {

	protected $fillable = [
							'id',
							'name',
                            'description',
	                     	'department_id'
						];
	protected $primaryKey = 'id';
	protected $table = 'sections';

	public function department() {
		return $this->belongsTo('App\Department');
	}

}
