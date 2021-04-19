<?php namespace App\Model;

use Eloquent;

class StudentProjPrefer extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'studentprojprefer';
	protected $connection = 'mysql';
	protected $fillable = ['userid','projectprefer1','projectprefer2','projectprefer3','projectprefer4','projectprefer5'];
}