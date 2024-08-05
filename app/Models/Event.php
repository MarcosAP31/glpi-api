<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //use HasFactory;
    protected $table='glpi_events';
    //public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['items_id','type','date','service','level','message'];
}

