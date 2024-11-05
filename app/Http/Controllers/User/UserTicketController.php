<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\PurchasedTicket;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Session\Session;

class UserTicketController extends Controller
{
    public function eventDetail($id){
        try {
            $event = Event::with('ticketTypes')->find($id);

            if (!$event) {
                return response()->json(['error' => 'Event not found.'], 404);
            }

            $user = User::find(Session('user_id'));

            return response()->json([
                'status' => 200,
                'event' => $event,
                'user' => $user,
            ]);
        } catch (Exception $e) {
            Log::error('Event detail error: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }


    public function bookEvent(Request $request)
    {        
        try {
            PurchasedTicket::create([
                'user_id' => Session('user_id'),
                'ticket_id' => $request->ticket_id, 
                'name' => $request->userName, 
                'email' => $request->userEmail, 
                'phone_number' => $request->userPhoneNumber,
                'quantity' => $request->quantity,
                'total' => $request->total, 
            ]);

            return response()->json(['message' => 'Ticket purchase successful!'], 200);
        } catch (Exception $e) {
            Log::error(message: 'Ticket purchase error: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }

}

