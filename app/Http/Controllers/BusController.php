<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Bus;
use App\Models\Stop;
use Illuminate\Http\Request;
use App\Http\Requests\BusRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){

        if ($request->isMethod('get')) {

            $stops = Stop::select('name')->distinct()->pluck('name');
            return view('index',compact('stops'));

        } elseif ($request->isMethod('post')) {

            $request->validate([
                'source' => 'required|string|max:255',
                'destination' => 'required|string|max:255',
            ]);

            $source = $request->input('source');
            $destination = $request->input('destination');

            $buses = Bus::with(['stop'])
                    ->where('source',$source)
                    ->where('destination',$destination)
                    ->get();

            // Formating the times for display
            foreach ($buses as $bus) {
                foreach ($bus->stop as $stop) {
                    $stop->arrival_time = Carbon::parse($stop->arrival_time)->format('h:i A');
                    $stop->departure_time = Carbon::parse($stop->departure_time)->format('h:i A');
                }
                $bus->departure_time = Carbon::parse($bus->departure_time)->format('h:i A');
            }

            // If no buses found, returning an empty array
            if ($buses->isEmpty()) {
                $buses = [];
            }

            $stops = Stop::select('name')->distinct()->pluck('name');
            return view('index', compact('buses','stops','source', 'destination'));
    
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BusRequest $req)
    {
        $req->all();

        $stops = [];
        foreach ($req->stopName as $i => $name) {
            $terminal = $req->stopTerminal[$i] ?? null;
            $time = $req->stopTime[$i] ?? null;
            $departure = Carbon::parse($time)->addMinute();
            if ($name && $time && $departure) {
                $stops[] = ['name' => $name, 'terminal_no' => $terminal, 'arrival_time' => $time, 'departure_time' => $departure];
            }
        }

        if (count($stops) < 2) {
            return redirect()->back()->with('error', 'At least two stops are required.');
        }

        $bus = new Bus();

        $source = $stops[0]['name']; 
        $destination = $stops[count($stops) - 1]['name'];
        
        $bus = Bus::create([
            'name' => $req->busName,
            'source' => $source,
            'destination' => $destination,
        ]);

        
        $bus->stop()->createMany($stops);

        return redirect()->route('admin')->with('success', 'Bus created successfully.');

    }

    /**
     * Display the specified route details.
     */
    public function show(int $id)
    {
        try {
            $buses = Bus::with('stop')->findOrFail($id);
            return view('details', compact('buses'));   
        } catch (ModelNotFoundException $e) {
            return redirect()->route('index')->with('error', 'Bus not found.');
        }
    }

    
}
