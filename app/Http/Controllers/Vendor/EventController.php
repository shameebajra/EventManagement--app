<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\EventRequest;
use App\Models\Event;
use App\Models\TicketType;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

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
    public function store(EventRequest $request)
    {
        try {
            $user_id = Session::get('user_id'); // Get the user ID from the session
            $poster = null;

            // Handle file upload if present
            if ($request->hasFile('poster')) {
                $poster = $request->file('poster')->store(path: 'resources/images/poster');
            }

            // Create event
            $event = Event::create([
                'event_name' => $request->event_name,
                'event_type' => $request->event_type,
                'event_details' => $request->event_details,
                'venue' => $request->venue,
                'location' => $request->location,
                'date' => $request->date,
                'time' => $request->time,
                'event_status' => $request->event_status,
                'terms' => $request->terms,
                'poster' => $poster,
                'user_id' => $user_id,
            ]);

            // Create ticket types
            foreach ($request->ticket_types as $ticket) {
                TicketType::create([
                    'event_id' => $event->id,
                    'ticket_type' => $ticket['ticket_type'],
                    'quantity' => $ticket['quantity'],
                    'price' => $ticket['price'],
                ]);
            }

            return redirect()->back()->with('success', 'Event created successfully!');

        } catch (Exception $e) {
            Log::error('Failed event creation: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Event creation unsuccessful!');
        }catch (QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'There was an issue with the database. Please try again later.']);
        }
    }



    /**
     * Display the specified resource.
     */
    public function show()
    {
        $events = Event::where('user_id',session('user_id'))->get();
        return view('vendor.events', compact('events'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $user_id = Session::get('user_id');
            $event = Event::with('ticketTypes')->findOrFail($id);

            if ($event->user_id !== $user_id) {
                return redirect()->back()->with('error', 'Unauthorized action. You cannot view this event.');
            }

            $ticketTypes = TicketType::where('event_id', $event->id)->get();

            return view('vendor.editEvent', compact('event', 'ticketTypes'));
        } catch (ModelNotFoundException $e) {
            Log::error('Event not found: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Event not found!');
        } catch (QueryException $e) {
            Log::error('Database error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'There was an issue retrieving the event. Please try again later.');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Get the user ID from the session
            $user_id = Session::get('user_id');

            // Find the event by ID
            $event = Event::with('ticketTypes')->findOrFail($id);

            // Check if the user ID matches the session ID
            if ($event->user_id !== $user_id) {
                return redirect()->back()->with('error', 'Unauthorized action. You cannot update this event.');
            }

            // Handle file upload if a new poster is uploaded
            $poster = $event->poster; // Keep the existing poster by default
            if ($request->hasFile('poster')) {
                // Delete the old poster if it exists
                if ($poster) {
                    Storage::delete($poster);
                }
                // Store the new poster
                $poster = $request->file('poster')->store('resources/images/poster');
            }

            // Update event details
            $event->update([
                'event_name'    => $request->event_name,
                'event_type'    => $request->event_type,
                'event_details' => $request->event_details,
                'venue'         => $request->venue,
                'location'      => $request->location,
                'date'          => $request->date,
                'time'          => $request->time,
                'event_status'  => $request->event_status,
                'terms'         => $request->terms,
                'poster'        => $poster,
            ]);

            // Update ticket types
            foreach ($request->ticket_types as $ticket) {
                // Check if ticket ID is set for updates
                if (isset($ticket['id'])) {
                    // Update existing ticket type
                    $ticketType = TicketType::where('id', $ticket['id'])
                        ->where('event_id', $event->id) // Ensure it belongs to the correct event
                        ->first();

                    if ($ticketType) {
                        $ticketType->update([
                            'ticket_type' => $ticket['ticket_type'],
                            'quantity'    => $ticket['quantity'],
                            'price'       => $ticket['price'],
                        ]);
                    }
                } else {
                    // Create a new ticket type if no ID is provided
                    TicketType::create([
                        'event_id'    => $event->id,
                        'ticket_type' => $ticket['ticket_type'],
                        'quantity'    => $ticket['quantity'],
                        'price'       => $ticket['price'],
                    ]);
                }
            }

            return redirect()->back()->with('success', 'Event updated successfully!');

        } catch (QueryException $e) {
            Log::error('Database error during event update: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'There was an issue with the database. Please try again later.']);

        } catch (ModelNotFoundException $e) {
            Log::error('Event not found: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Event not found!');

        } catch (Exception $e) {
            Log::error('Failed event update: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Event update unsuccessful!');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Get the user ID from the session
            $user_id = Session::get('user_id');

            // Find the event by ID
            $event = Event::findOrFail($id);

            // Check if the event belongs to the current user
            if ($event->user_id !== $user_id) {
                return redirect()->back()->with('error', 'Unauthorized action. You cannot delete this event.');
            }

            // Delete associated ticket types
            $event->ticketTypes()->delete();
            // Delete the event
            $event->delete();

            return redirect()->back()->with('success', value: 'Event deleted successfully!');

        } catch (ModelNotFoundException $e) {
            Log::error('Event not found: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Event not found!');

        } catch (QueryException $e) {
            Log::error('Database error during event deletion: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'There was an issue with the database. Please try again later.']);

        } catch (Exception $e) {
            Log::error('Failed event deletion: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Event deletion unsuccessful!');
        }
    }

    }
