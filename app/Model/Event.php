<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $fillable = [
        'title',
        'body',
        ];
    
        /*--Mapping: One Event: One User--*/
        public function user()
        {
            return $this->belongsTo('App\User');
        }
    
        /*--Mapping: One Event: Many Templates--*/
        public function template()
        {
            return $this->hasMany('App\Model\Template');
        
        }
    
        /*--Mapping: One Event: Many Certificates--*/
        public function certificate()
        {
            return $this->hasMany('App\Model\Certificate');
        
        }
}
