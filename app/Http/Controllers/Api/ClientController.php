<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();

        return response()->json([
            'Clients: ' => $clients,
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
        $client = Client::create($input);

        $client->assignRole('client');

        if($client->save()) {
            return response()->json([
                'message: ' => 'Client created!',
            ], 200);
        } else {
            return response([
                'message: ' => 'Client not created.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $client = Client::find($id);

        if(is_null($client)) {
            return response()->json([
                "message" => "Client not found!"
            ], 500);
        }

        return response()->json([
            'Client: ' => $client
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $client = Client::find($id);

        if($client){
           $input = $request->validate([
              'name' => ['required'],
              'phone' => ['required'],
              'socialNumber' => ['required'],
              'password' => ['required'],
            ]);

            $client->name = $input['name'];
            $client->phone = $input['phone'];
            $client->socialNumber = $input['socialNumber'];
            $client->password = $input['password'];

            if($client->save()){
                return response()->json([
                    'message: ' => 'Client updated!',
                    'Client: ' => $client
                ], 200);
            }else {
                return response([
                    'message: ' => 'Client not updated!',
                ], 500);
            }
        } else {
            return response([
                'message: ' => 'Client not found!',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $client = Client::find($id);

        if($client){
            $client->delete();

            return response()->json([
                'message: ' => 'Client deleted!',
            ], 200);
        } else {
            return response([
                'message: ' => 'Client not found!',
            ], 500);
        }
    }
}
