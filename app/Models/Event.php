<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable=[
        'event_name',
        'event_type',
        'event_details',
        'location',
        'venue',
        'date',
        'time',
        'ticket_type',
        'event_status',
    ];

    protected $hidden =[
        'user_id',
    ];
}
