<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LandingPageController extends Controller
{
    public function showEvent()
    {
        try{
            $events = Event::with('ticketTypes')
                            ->latest('updated_at')
                            ->get();

            $latestDate = Event::max('date');
            $latestEvents = Event::where('date', $latestDate)
                            ->where('event_status','active')
                            ->take(6)->get();

            return view('welcome',compact("events","latestEvents"));
        }catch (Exception $e)
        {
            Log::error(message: 'Event display unsuccessful!: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Event display unsuccessful!');

        }

    }
    public function eventDetail(string $id)
    {
        try{
            $event = Event::with('ticketTypes')
                          ->with('user')
                          ->findOrFail($id);
            return view('eventDetail', compact('event'));


        }catch (Exception $e)
        {
            Log::error(message: 'Event display unsuccessful!: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Event display unsuccessful!');

        }

    }







    // public function eventSearch(Request $request){
    //     try{
    //         $search = $request->input('search');
    //         $events= Event::where('event_name', 'ilike', "%{$search}%")
    //                        ->orWhere('event_type', 'ilike', "%{$search}%")
    //                        ->latest('updated_at')
    //                        ->get();

    //         $latestDate = Event::max('date');
    //         $latestEvents = Event::where('date', $latestDate)->take(6)->get();
    //         return view('welcome',compact("events","latestEvents"));


    //     }catch (Exception $e)
    //     {
    //         return redirect()->back()->with('error', 'Event search unsuccessful!');

    //     }

    // }
}
