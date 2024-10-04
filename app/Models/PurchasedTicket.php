<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchasedTicket extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'total',
    ];

    protected $hidden = [
        'user_id',
        'ticket_id',
        'promo_code_id',
    ];
}

