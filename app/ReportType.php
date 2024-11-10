<?php
namespace App;
use Eloquent;

class ReportType extends Eloquent {

	protected $fillable = [
							'id',
							'name',
                            'description',
						];
	protected $primaryKey = 'id';
	protected $table = 'reports_types';

}
