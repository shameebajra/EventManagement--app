<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\PurchasedTicket;
use App\Models\TicketType;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SuperadminEventController extends Controller
{


    /**
     * Display at dashboard
     */
    public function index()
    {
        try {
            $transactions = PurchasedTicket::with(['ticketTypes.event'])
                ->latest()
                ->paginate(20);

            $events = Event::with('user')->latest()->get();

            $totalEvents = Event::count();
            $totalTicketSales = PurchasedTicket::sum('total');
            $totalTicketSold = PurchasedTicket::count();

            return view('superadmin.dashboard', compact('transactions', 'totalEvents', 'events', 'totalTicketSales', 'totalTicketSold'));
        } catch (Exception $e) {
            Log::error('Transactions error: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }

    /**
     * Retrieve and display all events.
     */
    public function getEvents()
    {
        try {
            $events = Event::paginate(10);
            return view('superadmin.events', compact('events'));
        } catch (Exception $e) {
            Log::error('Error fetching events: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to retrieve events.');
        }
    }

    /**
     * Show event details along with associated ticket types.
     */
    public function showEventDetail(string $id)
    {
        try {
            $event = Event::with('ticketTypes')->findOrFail($id);
            $ticketTypes = TicketType::where('event_id', $event->id)->get();

            return view('superadmin.eventDetail', compact('event', 'ticketTypes'));
        } catch (ModelNotFoundException $e) {
            Log::error('Event not found: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Event not found!');
        } catch (QueryException $e) {
            Log::error('Database error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'There was an issue retrieving the event. Please try again later.');
        }
    }

    /**
     * Retrieve and display all users with specific roles.
     */
    public function getUsers()
    {
        try {
            $users = User::whereIn('role_id', [2, 3])->paginate(10);
            return view('superadmin.users', compact('users'));
        } catch (Exception $e) {
            Log::error('Error fetching users: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to retrieve users.');
        }
    }

    /**
     * Delete an event by its ID.
     */
    public function destroy(string $id)
    {
        try {
            $event = Event::findOrFail($id);
            $event->delete();
            return redirect()->back()->with('success', 'Event deleted successfully!');
        } catch (ModelNotFoundException $e) {
            Log::error('Event not found for deletion: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Event not found!');
        } catch (Exception $e) {
            Log::error('Failed event deletion: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Event deletion unsuccessful!');
        }
    }

    /**
     * Search for events by name or type.
     */
    public function eventSearch(Request $request)
    {
        try {
            $search = $request->input('search');

            $events = Event::where('event_name', 'ilike', "%{$search}%")
                ->orWhere('event_type', 'ilike', "%{$search}%")
                ->latest('updated_at')
                ->paginate(10);

            return view('superadmin.events', compact('events'))->with('search', $search);
        } catch (Exception $e) {
            Log::error('Event search error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Event search failed!');
        }
    }


    public function userSearch(Request $request)
    {
        try {
            $search = $request->input('search');

            $users = User::where('name', 'ilike', "%{$search}%")
                ->orWhere('email', 'ilike', "%{$search}%")
                ->orWhere('phone_number', 'ilike', "%{$search}%")
                ->latest('updated_at')
                ->paginate(10);
            return view('superadmin.users', compact('users'))->with('search', $search);
        } catch (Exception $e) {
            Log::error('User search error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'User search failed!');
        }
    }
}
