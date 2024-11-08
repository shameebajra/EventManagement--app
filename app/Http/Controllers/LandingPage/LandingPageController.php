<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LandingPageController extends Controller
{
    public function showEvent()
    {
    try {
        $today = Carbon::now()->setTimezone('Asia/Kathmandu');
        $todayDate = $today->format('Y-m-d');
        $currentTime = $today->format('H:i:s');

        // Events today and later
        $events = Event::where('date', '>=', $todayDate)
                        ->where(function($query) use ($todayDate, $currentTime) {
                            $query->where('date', '>', $todayDate)
                                  ->orWhere('time', '>=', $currentTime);
                        })
                        ->latest('date')
                        ->get();

        // Latest events for this month
        $startOfMonth = $today->copy()->startOfMonth()->format('Y-m-d');
        $endOfMonth = $today->copy()->endOfMonth()->format('Y-m-d');

        $latestEvents = Event::whereBetween('date', [$startOfMonth, $endOfMonth])
                             ->where(function($query) use ($todayDate, $currentTime) {
                                 $query->where('date', '>', $todayDate)
                                       ->orWhere('time', '>=', $currentTime);
                             })
                             ->where('event_status', 'active')
                             ->take(6)
                             ->get();

        return view('welcome', compact("events", "latestEvents"));
    } catch (Exception $e) {
        Log::error('Event display unsuccessful!: ' . $e->getMessage());
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
