<?php

namespace App\Http\Controllers\User;

use Exception;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\PurchasedTicket;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Jobs\SendTicketPurchaseEmail;
use App\Mail\TicketPurchaseEmail;

use App\Models\TicketType;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserTicketController extends Controller
{
    public function eventDetail($id)
    {
        try {
            $event = Event::with(['ticketTypes' => function($query) {
                // Filter ticket types where quantity is greater than 0
                $query->where('quantity', '>', 0);
            }])->find($id);

            if (!$event) {
                return response()->json(['error' => 'Event not found.'], 404);
            }

            // Check if any ticket types are available
            if ($event->ticketTypes->isEmpty()) {
                return response()->json(['error' => 'No tickets available for this event.'], 404);
            }

            // Get user data
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
        $validator = Validator::make($request->all(), [
            'ticket_id' => 'required|exists:ticket_types,id',
            'quantity' => 'required|integer|min:1',
            'userName' => 'required|string|max:255',
            'userEmail' => 'required|email|max:255',
            'userPhoneNumber' => 'required|numeric|digits_between:10,15',
            'total' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first(),
            ], 400);
        }

        DB::beginTransaction();

        try {
            $ticket = TicketType::findOrFail($request->ticket_id);

            // Check if the requested quantity is available
            if ($request->quantity > $ticket->quantity) {
                DB::rollBack();
                return response()->json(['error' => 'The requested quantity exceeds available tickets.'], 400);
            }


            $purchasedTicket = PurchasedTicket::create([
                'user_id' => Session('user_id'),
                'ticket_id' => $request->ticket_id,
                'name' => $request->userName,
                'email' => $request->userEmail,
                'phone_number' => $request->userPhoneNumber,
                'quantity' => $request->quantity,
                'total' => $request->total,
            ]);

            $ticket->quantity -= $request->quantity;
            $ticket->save();

            // Dispatch email job
            SendTicketPurchaseEmail::dispatch($purchasedTicket, $request->userEmail);
            Log::info('Email Sent Successfully');

            DB::commit();

            return response()->json(['message' => 'Ticket purchase successful!'], 200);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Ticket purchase error: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }


    public function myTicket(){
        try{
            $purchasedTickets = PurchasedTicket::with(['ticketTypes','ticketTypes.event'])
            ->where('user_id', Session('user_id'))
            ->latest()
            ->get();

            return view('user.myPurchasedTicket', compact('purchasedTickets'));
        }catch (Exception $e) {
            Log::error(message: 'Purchase ticket error: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }

}

