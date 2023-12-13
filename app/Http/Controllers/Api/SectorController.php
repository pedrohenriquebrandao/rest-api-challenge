<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use Illuminate\Http\Request;

class SectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sectors = Sector::all();

        return response()->json([
            'sectors: ' => $sectors,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'label' => ['required'],
        ]);

        $sector = Sector::create($input);

        if($sector->save()) {
            return response()->json([
                'message: ' => 'Sector created!',
            ], 200);
        } else {
            return response([
                'message: ' => 'Sector not created.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sector = Sector::find($id);

        if(is_null($sector)) {
            return response()->json([
                "message" => "Sector not found!"
            ], 500);
        }

        return response()->json([
            'sector: ' => $sector
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $sector = Sector::find($id);

        if($sector){
           $input = $request->validate([
              'label' => ['required'],
            ]);

            $sector->label = $input['label'];

            if($sector->save()){
                return response()->json([
                    'message: ' => 'Sector updated!',
                    'sector: ' => $sector
                ], 200);
            }else {
                return response([
                    'message: ' => 'Sector not updated!',
                ], 500);
            }
        } else {
            return response([
                'message: ' => 'Sector not found!',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $sector = Sector::find($id);

        if($sector){
            $sector->delete();

            return response()->json([
                'message: ' => 'Sector deleted!',
            ], 200);
        } else {
            return response([
                'message: ' => 'Sector not found!',
            ], 500);
        }
    }
}
