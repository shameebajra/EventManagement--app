<?php

namespace App\Http\Controllers\LandingPage;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Exception;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function showEvent()
    {
        try{
            $events = Event::latest('updated_at')->get();

            $latestDate = Event::max('date');
            $latestEvents = Event::where('date', $latestDate)->take(6)->get();

            return view('welcome',compact("events","latestEvents"));
        }catch (Exception $e)
        {
            return redirect()->back()->with('error', 'Event display unsuccessful!');

        }

    }
}
