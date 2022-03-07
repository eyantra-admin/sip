<?php namespace App\Model;

use Eloquent;

class OnlineProfile extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'online_profile_response';
	protected $connection = 'mysql';
	protected $guarded = []; 
}