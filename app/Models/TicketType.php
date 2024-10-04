<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_name',
        'ticket_type',
        'quantity',
        'price',
    ];

    protected $hidden=[
        'event_id',
    ];
}
