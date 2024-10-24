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
        'total',
        'user_id',
        'ticket_id',
    ];
}
