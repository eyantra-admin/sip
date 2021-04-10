<?php namespace App\Model;

use Eloquent;

class ElsiState extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'elsi_state';
	protected $connection = 'mysql_1';
}