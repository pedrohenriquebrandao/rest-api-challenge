<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'banner' => ['required'],
            'producer_id' => ['required']
        ]);

        $event = Event::create($input);

        if($request->hasFile('banner')) {
            $file = $request->file('banner');
            $filename = $file->getClientOriginalName();
            $event->banner = $filename;

            Storage::disk('s3')->putFileAs($file , 'banners/' . $filename); // Add the banner image to AWS S3
        }

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
            'event: ' => [
                'name' => $event->name,
                'city' => $event->city,
                'location' => $event->location,
                'banner' => $event->banner,
                'producer' => $event->producer->name,
            ]
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
                'banner'=> ['required'],
                'producer_id' => ['required'],
            ]);

            $event->name = $input['name'];
            $event->city = $input['city'];
            $event->location = $input['location'];
            $event->producer_id = $input['producer_id'];

            if($request->hasFile('banner')) {
                $file = $request->file('banner');
                $filename = $file->getClientOriginalName();

                Storage::disk('s3')->delete('banners/' . $event->banner); // Delete the older banner image from AWS S3
                $event->banner = $filename;

                Storage::disk('s3')->putFileAs($file , 'banners/' . $filename);
            }

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

        if($event->banner) {
            Storage::disk('s3')->delete('banners/' . $event->banner);
        }

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

    /**
     * Display the banner image of the event
     */
    public function getBannerImage($id) {

        $event = Event::find($id);

        if($event->banner) {
            return Storage::disk('s3')->response('banners/' . $event->banner);
        }
    }
}
