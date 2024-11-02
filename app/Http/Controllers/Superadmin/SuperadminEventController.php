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
     * Display a listing of the resource.
     */

     public function index(){
        $usersCount = User::where('role_id', 3)->count();
        $vendorsCount = User::where('role_id', 2)->count();
        $tickets=PurchasedTicket::all();


        return view('superadmin.dashboard', compact('usersCount','vendorsCount','tickets'));
     }
    public function getEvents()
    {
        $events= Event::all();
        return view('superadmin.events',compact('events'));
    }

    public function showEventDetail(string $id)
    {
        try{
        $event = Event::with('ticketTypes')->findOrFail($id);
        $ticketTypes = TicketType::where('event_id', $event->id)->get();

        return view('superadmin.eventDetail',compact('event','ticketTypes'));
        } catch (ModelNotFoundException $e) {
            Log::error('Event not found: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Event not found!');
        } catch (QueryException $e) {
            Log::error('Database error: ' . $e->getMessage());

            return redirect()->back()->with('error', 'There was an issue retrieving the event. Please try again later.');
        }

    }


    public function getUsers()
    {
        $users = User::whereIn('role_id', [2, 3])->get();
        return view('superadmin.users',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $event = Event::findOrFail($id);
            $event->delete();
            return redirect()->back()->with('success', value: 'Event deleted successfully!');

        }catch(Exception $e){
            Log::error('Failed event deletion: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Event deletion unsuccessful!');
        }

    }

    public function eventSearch(Request $request){
        try {
        $search = $request->input('search');

        $events= Event::where('event_name', 'ilike', "%{$search}%")
        ->orWhere('event_type', 'ilike', "%{$search}%")->latest('updated_at')->get();

        return view('superadmin.events', compact('events'))->with('search', $search);
        }catch (Exception $e){
            return redirect()->back()->with('error', 'Event search failed!');
        }
    }
}
