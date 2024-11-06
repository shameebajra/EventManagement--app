<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\PurchasedTicket;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Mail\TicketPurchaseEmail;

use App\Models\TicketType;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Mail;

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
            $purchasedTicket= PurchasedTicket::with(['ticketTypes','ticketTypes.event'])->create([
                'user_id' => Session('user_id'),
                'ticket_id' => $request->ticket_id,
                'name' => $request->userName,
                'email' => $request->userEmail,
                'phone_number' => $request->userPhoneNumber,
                'quantity' => $request->quantity,
                'total' => $request->total,
            ]);
            Log::info('Purchased Ticket Created Successfully', ['purchasedTicket' => $purchasedTicket]);

            //decrease quantity in ticketTypes on ticket purchase
            $ticket = $purchasedTicket->ticketTypes;
            $ticket->quantity = $ticket->quantity - $request->quantity;
            $ticket->save();

            Log::info('Quantity Decrease error', ['event' => $ticket]);

            //  Attempt to send the email
            Mail::to($request->userEmail)->send(new TicketPurchaseEmail($purchasedTicket));
            Log::info('Email Sent Successfully');


            return response()->json(['message' => 'Ticket purchase successful!'], 200);
        } catch (Exception $e) {
            Log::error(message: 'Ticket purchase error: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }


    public function myTicket(){
        try{
            $purchasedTickets = PurchasedTicket::with(['ticketTypes','ticketTypes.event'])
            ->where('user_id', Session('user_id'))
            ->latest()
            ->get();
            // dd($purchasedTickets->all());

            return view('user.myPurchasedTicket', compact('purchasedTickets'));
        }catch (Exception $e) {
            Log::error(message: 'Purchase ticket error: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }

}

