<?php namespace App\Model;

use Eloquent;

class StudentEvaluation extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'student_evaluation';
	protected $connection = 'mysql';

	protected $guarded = []; 
}