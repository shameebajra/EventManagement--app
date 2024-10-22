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
        'poster',    
        'terms',        
        'event_status',
        'user_id',
    ];

    public function ticketTypes()
    {
        return $this->hasMany(TicketType::class); 
    }


    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
