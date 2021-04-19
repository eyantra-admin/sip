<?php namespace App\Model;

use Eloquent;

class UserPanel extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user_panel';
	protected $connection = 'mysql';
}