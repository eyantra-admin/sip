<?php namespace App\Model;

use Eloquent;

class TimeslotBooking extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'timeslot_booking';
	protected $connection = 'mysql';

	 protected $fillable = ['date','availableslots','availableflag','userid'];
}