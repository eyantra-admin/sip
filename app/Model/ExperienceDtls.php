<?php namespace App\Model;

use Eloquent;

class ExperienceDtls extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'experience_dtls';
	protected $connection = 'mysql';
	protected $guarded = []; 
}