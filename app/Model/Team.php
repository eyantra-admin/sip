<?php

namespace App\Model;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    // use HasFactory;
    protected $fillable = [
        'name', 
        'price', 
        'detail', 
        'status'
    ];    
}