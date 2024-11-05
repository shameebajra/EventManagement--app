<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedTicket extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'quantity',
        'total',
        'user_id',
        'ticket_id',
        'ticket',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ticketTypes(){
        return $this->belongsTo(TicketType::class,'ticket_id', 'id' );
    }

    public function event(){
        return $this->hasOneThrough(Event::class, TicketType::class,'event_id','id');
    }

}
