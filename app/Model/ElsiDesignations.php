<?php namespace App\Model;

use Eloquent;

class ElsiDesignations extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'elsi_designations';
	protected $connection = 'mysql_1';
}