<?php
namespace App;
use Eloquent;

class Branch extends Eloquent {

	protected $fillable = [
							'id',
							'name',
                            'description',
						];
	protected $primaryKey = 'id';
	protected $table = 'branchs';


}
