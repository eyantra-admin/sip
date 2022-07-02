<?php namespace App\Model;

use Eloquent;

class ProgressEval extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'intern_eval';
	protected $connection = 'mysql';

	protected $guarded = []; 
}