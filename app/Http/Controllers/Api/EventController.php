<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();

        return response()->json([
            'events: ' => $events,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => ['required'],
            'city' => ['required'],
            'location' => ['required'],
            'producer_id' => ['required']
        ]);

        $event = Event::create($input);

        if($event->save()) {
            return response()->json([
                'message: ' => 'Event created!',
            ], 200);
        } else {
            return response([
                'message: ' => 'Event not created.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $event = Event::find($id);

        if(is_null($event)) {
            return response()->json([
                "message" => "Event not found!"
            ], 500);
        }

        return response()->json([
            'event: ' => $event
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $event = Event::find($id);

        if($event){
           $input = $request->validate([
                'name' => ['required'],
                'city' => ['required'],
                'location' => ['required'],
                'producer_id' => ['required'],
            ]);

            $event->name = $input['name'];
            $event->city = $input['city'];
            $event->location = $input['location'];
            $event->producer_id = $input['producer_id'];

            if($event->save()){
                return response()->json([
                    'message: ' => 'Event updated!',
                    'event: ' => $event
                ], 200);
            }else {
                return response([
                    'message: ' => 'Event not updated!',
                ], 500);
            }
        } else {
            return response([
                'message: ' => 'Event not found!',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::find($id);

        if($event){
            $event->delete();

            return response()->json([
                'message: ' => 'Event deleted!',
            ], 200);
        } else {
            return response([
                'message: ' => 'Event not found!',
            ], 500);
        }
    }
}
