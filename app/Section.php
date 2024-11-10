<?php
namespace App;
use Eloquent;

class Section extends Eloquent {

	protected $fillable = [
							'id',
							'name',
                            'description',
						];
	protected $primaryKey = 'id';
	protected $table = 'sections';


}
