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
	protected $fillable =['userid', 'projectid', 'skill_match', 'strength', 'efforts', 'output', 'academic_load', 'extention', 'communication', 'remarks'];
	protected $guarded = []; 
}