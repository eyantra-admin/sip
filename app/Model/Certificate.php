<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    //
    protected $fillable = [
    	'id',
    	'team_id',
    	'c_id',
	'random',
	'hash',
	'keyValue',
	'validFlag',
	'generated_at',
	'userDetailsId'
	];

	/*--Mapping: One Ceritificate: One User--*/
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	/*--Mapping: One Certificate: One Template--*/
	public function template()
	{
		return $this->belongsTo('App\Model\Template');
	}

	/*--Mapping: One Certificate: One Event--*/
	public function event()
	{
		return $this->belongsTo('App\Model\Event');
	
	}
}
