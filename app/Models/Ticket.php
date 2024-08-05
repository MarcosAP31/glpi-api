<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //use HasFactory;
    protected $table='glpi_tickets';
    //public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['entities_id','name','date','closedate','solvedate','users_id_recipient'];
}
