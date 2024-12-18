<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketType extends Model
{
    use HasFactory;
    protected $fillable = [
        'ticket_type',
        'quantity',
        'price',
        'event_id',

    ];

    protected $hidden=[
    ];

    public function event(){
        return $this->belongsTo(Event::class);
    }
}
