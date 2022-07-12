<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InternEvaluation extends Model
{
    //
    protected $table = 'intern_eval';
	protected $connection = 'mysql';
	protected $fillable =['userid', 'projectid', 'skill_match', 'strength', 'efforts', 'output', 'academic_load', 'extention', 'communication', 'tech_skill', 'quality','attitude','punctuality','team_work','documentation','presentation','content', 'remarks'];
	protected $guarded = []; 
}