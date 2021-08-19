<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    //
    protected $fillable = [
        'name',
        'title',
        'body',
        'field'
    
        ];
        /*--Mapping: One template: One user--*/
        public function user()
        {
            return $this->belongsTo('App\User');
        
        }
    
        /*--Mapping: One template: One event--*/
        public function event()
        {
            return $this->belongsTo('App\Model\Event');
        
        }
    
        /*--Mapping: One template: Many Certificates--*/
        public function certificate()
        {
            return $this->hasMany('App\Model\Certificate');
        }
}
