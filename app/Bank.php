<?php
namespace App;
use Eloquent;

class Bank extends Eloquent {

	protected $fillable = [
							'bank_name',
							'account_name',
							'account_number',
							'branch',
							'routing_number',
							'swift_code',
							'description',
							'status'
						];
	protected $primaryKey = 'id';
	protected $table = 'company_banks';
}
