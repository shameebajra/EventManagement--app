<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\PurchasedTicket;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class EventTransactionController extends Controller
{
    public function allTransaction(){
        try{
            $transactions = $this->transaction();

             return view('vendor.transaction', compact('transactions'));
        }catch (Exception $e) {
            Log::error(message: 'Transactions error: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }

    public function transaction(){
        $transactions = PurchasedTicket::with(['ticketTypes.event'])
                            ->whereHas('ticketTypes.event',function($query){
                                $query->where('user_id', Session('user_id'));
                            })->latest()->paginate(20);

         return $transactions;
    }

      public function searchTransaction(Request $request){
        try {
            $search = $request->input('search');
            $userId = Session::get('user_id');

            $transactions = PurchasedTicket::with(['ticketTypes.event'])
                ->whereHas('ticketTypes.event', function($query) use ($userId, $search) {
                    $query->where('user_id', $userId)
                        ->where(function ($query) use ($search) {
                            $query->where('event_name', 'ilike', "%{$search}%")
                                  ->orWhere('name', 'ilike', "%{$search}%")
                                  ->orWhere('id', 'ilike', "%{$search}%");
                        });
                })
                ->latest()
                ->paginate(20);

            return view('vendor.transaction', compact('transactions'));
        } catch (Exception $e) {
            Log::error('Transaction search error: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }

    public function dashboard(){
        try{
            $transactions = $this->transaction();
            $totalEvents = Event::where('user_id', Session('user_id'))->count();

            $events = Event::where('user_id', Session('user_id'))->latest()->get();

            $totalTicketSales = PurchasedTicket::with(['ticketTypes.event'])
                                ->whereHas('ticketTypes.event', function ($query) {
                                    $query->where('user_id', Session('user_id'));
                                })
                                ->sum('total');

            $totalTicketSold=PurchasedTicket::with(['ticketTypes.event',])
                            ->whereHas('ticketTypes.event', function($query){
                                $query->where('user_id', Session('user_id'));
                            })->count();

             return view('vendor.dashboard', compact('transactions','totalEvents', 'events','totalTicketSales','totalTicketSold'));
        }catch (Exception $e) {
            Log::error(message: 'Transacions error: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }

}
