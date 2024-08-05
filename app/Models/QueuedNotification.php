<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QueuedNotification extends Model
{
    //use HasFactory;
    protected $table='glpi_queuednotifications';
    //public $timestamps = false;
    protected $primaryKey = 'id';
    protected $fillable = ['itemtype','items_id','entities_id','name','sender','sendername','recipient','recipientname','body_text'];
}

