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
        $events=Event::all();
        return view('welcome',compact("events"));
        }catch(Exception $e)
        {
            return redirect()->back()->with('error', 'Event display unsuccessful!');

        }

    }
}
