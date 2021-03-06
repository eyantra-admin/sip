<?php namespace App\Model;

use Eloquent;

class Projects extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'projects';
	protected $connection = 'mysql';
	protected $fillable = ['projectname'];
}