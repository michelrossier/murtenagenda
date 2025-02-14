<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $query = Event::query();

        // Date filter
        if ($request->has('date')) {
            $query->whereDate('date', $request->date);
        }

        // Letter filter
        if ($request->has('letter')) {
            $query->where('name', 'like', $request->letter . '%');
        }

        // Get all available first letters
        $availableLetters = Event::select(DB::raw('DISTINCT UPPER(LEFT(name, 1)) as letter'))
            ->orderBy('letter')
            ->pluck('letter')
            ->filter()
            ->values();

        $events = $query->orderBy('date', 'asc')
                       ->paginate(10)
                       ->withQueryString();

        return view('events.index', compact('events', 'availableLetters'));
    }
} 