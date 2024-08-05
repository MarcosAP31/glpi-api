<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Followup extends Model
{
    //use HasFactory;
    protected $table='glpi_itilfollowups';
    //public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['itemtype','items_id','date','users_id','users_id_editor','content','is_private','requesttypes_id','date_mod','date_creation'];
}
