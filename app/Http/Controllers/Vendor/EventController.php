<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\EventRequest;
use App\Models\Event;
use App\Models\PurchasedTicket;
use App\Models\TicketType;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{

    public function store(EventRequest $request)
    {
        try {
            DB::beginTransaction();
            $user_id = Session::get('user_id');
            $poster = null;

            $poster = $request->poster;

            if ($poster){
                $extention = $poster->getClientOriginalExtension();
                $posterName = time(). '.'.$extention;
                $poster->move(public_path('/images/eventPoster'),$posterName);
            } else {
                $posterName = "0.png";
            }
            // Create event
            $event = Event::create ([
                'event_name' => $request->event_name,
                'event_type' => $request->event_type,
                'event_details' => $request->event_details,
                'venue' => $request->venue,
                'location' => $request->location,
                'date' => $request->date,
                'time' => $request->time,
                'event_status' => $request->event_status,
                'terms' => $request->terms,
                'poster' => $posterName,
                'user_id' => $user_id,
            ]);

            //Loops through each request and save it
            foreach ($request->ticket_types as $ticket) {
                TicketType::create([
                    'event_id' => $event->id,
                    'ticket_type' => $ticket['ticket_type'],
                    'quantity' => $ticket['quantity'],
                    'price' => $ticket['price'],
                ]);
            }

            DB::commit();

            return redirect()->back()->with('success', 'Event created successfully!');

        } catch (Exception $e) {
            DB::rollBack();
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
        try{
        $events = Event::where('user_id',session('user_id'))->latest('updated_at')->paginate(10);

        return view('vendor.events', compact('events'));
        }catch (Exception $e) {
            Log::error('Failed event display: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Event display unsuccessful!');
        }
    }

    public function showEventDetail(string $id)
    {
        try {
            $user_id = Session::get('user_id');
            $event = Event::with('ticketTypes')->findOrFail($id);

            if ($event->user_id !== $user_id) {
                return redirect()->back()->with('error', 'Unauthorized action. You cannot view this event.');
            }

            $ticketTypes = TicketType::where('event_id', $event->id)->get();

            return view('vendor.eventDetail', compact('event', 'ticketTypes'));
        } catch (ModelNotFoundException $e) {
            Log::error('Event not found: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Event not found!');
        } catch (QueryException $e) {
            Log::error('Database error: ' . $e->getMessage());

            return redirect()->back()->with('error', 'There was an issue retrieving the event. Please try again later.');
        }

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
        } catch (Exception $e) {
            DB::rollback();

            Log::error('Failed event deletion: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Event deletion unsuccessful!');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, string $id)
    {
        try {
            DB::beginTransaction();

            $user_id = Session::get('user_id');

            $event = Event::with('ticketTypes')->findOrFail($id);

            if ($event->user_id !== $user_id) {
                return redirect()->back()->with('error', 'Unauthorized action. You cannot update this event.');
            }


            if ($request->hasFile('poster')) {
                $poster = $request->file('poster');
                $extension = $poster->getClientOriginalExtension();
                $posterName = time() . '.' . $extension;
                $poster->move(public_path('/images/eventPoster'), $posterName);

                // delete old poster if new uploaded
                if ($event->poster && $event->poster !== "0.png") {
                    $oldPosterPath = public_path('/images/eventPoster/' . $event->poster);
                    if (file_exists($oldPosterPath)) {
                        unlink($oldPosterPath);
                    }
                }
            } else {
                // Keep the old poster
                $posterName = $event->poster;
            }


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
                'poster'        => $posterName,
            ]);

            // Update ticket types
            $existingTicketIds = [];


            foreach ($request->ticket_types as $ticket) {
                if (isset($ticket['id'])) {
                        $ticketType = TicketType::where('id', $ticket['id'])
                        ->where('event_id', $event->id)
                        ->first();

                    if ($ticketType) {
                        $ticketType->update([
                            'ticket_type' => $ticket['ticket_type'],
                            'quantity'    => $ticket['quantity'],
                            'price'       => $ticket['price'],
                        ]);
                    }

                    // Add the updated ticket ID to the existing array
                    $existingTicketIds[] = $ticket['id'];
                } else {
                    // Create a new ticket
                    $newTicketType = TicketType::create([
                        'event_id'    => $event->id,
                        'ticket_type' => $ticket['ticket_type'],
                        'quantity'    => $ticket['quantity'],
                        'price'       => $ticket['price'],
                    ]);

                    $existingTicketIds[] = $newTicketType->id;
                }
            }

            TicketType::where('event_id', $event->id)
                ->whereNotIn('id', $existingTicketIds)
                ->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Event updated successfully!');

        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Failed event update: ' . $e->getMessage());
            return view('vendor.events')->with('error', 'Event update unsuccessful!');
        }
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $user_id = Session::get('user_id');

            $event = Event::findOrFail($id);

            if ($event->user_id !== $user_id) {
                return redirect()->back()->with('error', 'Unauthorized action. You cannot delete this event.');
            }


            $event->ticketTypes()->delete();
            $event->delete();

            DB::commit();

            return redirect()->back()->with('success', value: 'Event deleted successfully!');

        } catch (Exception $e) {
            DB::rollback();

            Log::error('Failed event deletion: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Event deletion unsuccessful!');
        }
    }

    public function ticketDestroy(string $id){
     try {
        $user_id = Session::get('user_id');
        Log::info("Deleting ticket ID: {$id} for user ID: {$user_id}");

        $ticketType = TicketType::where('id', $id)
            ->whereHas('event', function($query) use ($user_id) {
                $query->where('user_id', $user_id);
            })
            ->first();

        if ($ticketType) {
            $ticketType->delete();
            Log::info("Ticket ID {$id} deleted successfully.");

            return response()->json(['success' => 'Ticket deleted successfully.']);
        } else {
            Log::warning("Ticket ID {$id} not found or not authorized.");
            return response()->json(['error' => 'Ticket not found or not authorized.']);
        }
    } catch (Exception $e) {
        Log::error('Ticket deletion error: ' . $e->getMessage());
        return response()->json(['error' => 'An error occurred while deleting the ticket.']);
    }
    }


    public function search(Request $request){
        try{
        $search = $request->input('search');
        $userId = session('user_id');

        $events = Event::where('user_id', $userId)
                    ->when($search, function($query, $search) {
                        return $query->where('event_name', 'ilike', "%{$search}%")
                                     ->orWhere('event_type', 'ilike', "%{$search}%");
                    })->latest('updated_at')->paginate(10);

        return view('vendor.events', compact('events'))->with('search', $search);
        }catch(Exception $e){
            return redirect()->back()->with('error', 'Event search failed!');
        }

    }

    public function showSoldTickets($id){
        try{
            $showSoldTickets = PurchasedTicket::with(['ticketTypes', 'ticketTypes.event'])
                                ->whereHas('ticketTypes.event', function($query) use ($id) {
                                    $query->where('id', $id);
                                })
                                ->get();

            $totalSoldTickets = PurchasedTicket::with(['ticketTypes', 'ticketTypes.event'])
                                ->whereHas('ticketTypes.event', function($query) use ($id) {
                                    $query->where('id', $id);
                                })
                                ->sum('quantity');

            $totalEarned = PurchasedTicket::with(['ticketTypes', 'ticketTypes.event'])
                            ->whereHas('ticketTypes.event', function($query) use ($id) {
                                $query->where('id', $id);
                            })
                            ->sum('total');


            return view('vendor.soldTickets', compact('showSoldTickets','totalSoldTickets','totalEarned'));



        }catch (Exception $e) {
            Log::error(message: 'Sold tickets error: ' . $e->getMessage());
            return response()->json(['error' => 'An unexpected error occurred. Please try again later.'], 500);
        }
    }


}

