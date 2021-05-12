<?php namespace App\Model;

use Eloquent;

class EysipUploads extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sipuploads';
	protected $connection = 'mysql';
	protected $fillable = ['userid','photo','signature','pancard'];
}