<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Producer;
use Illuminate\Http\Request;

class ProducerController extends Controller
{
    public function __construct() {
        $this->middleware(
            ['auth:sanctum','ability:producer-index,producer-store,producer-update,producer-delete,producer-events,producer-sectors,producer-batches,producer-coupons,producer-tickets']);
    }

   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $producers = Producer::all();

        return response()->json([
            'producers: ' => $producers,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => ['required'],
            'phone' => ['required'],
            'socialNumber' => ['required'],
            'password' => ['required'],
        ]);

        $input['password']= bcrypt($input['password']);
        $producer = Producer::create($input);

        $producer->assignRole('producer');

        if($producer->save()) {
            return response()->json([
                'message: ' => 'Producer created!',
            ], 200);
        } else {
            return response([
                'message: ' => 'Producer not created.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $producer = Producer::find($id);

        if(is_null($producer)) {
            return response()->json([
                "message" => "Producer not found!"
            ], 500);
        }

        return response()->json([
            'producer: ' => $producer
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $producer = Producer::find($id);

        if($producer){
           $input = $request->validate([
              'name' => ['required'],
              'phone' => ['required'],
              'socialNumber' => ['required'],
              'password' => ['required'],
            ]);

            $producer->name = $input['name'];
            $producer->phone = $input['phone'];
            $producer->socialNumber = $input['socialNumber'];
            $producer->password = bcrypt($input['password']);

            if($producer->save()){
                return response()->json([
                    'message: ' => 'Producer updated!',
                    'producer: ' => $producer
                ], 200);
            }else {
                return response([
                    'message: ' => 'Producer not updated!',
                ], 500);
            }
        } else {
            return response([
                'message: ' => 'Producer not found!',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $producer = Producer::find($id);

        if($producer){
            $producer->delete();

            return response()->json([
                'message: ' => 'Producer deleted!',
            ], 200);
        } else {
            return response([
                'message: ' => 'Producer not found!',
            ], 500);
        }
    }
}
