<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketUser extends Model
{
    //use HasFactory;
    protected $table='glpi_tickets_users';
    //public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['tickets_id','users_id'];
}
