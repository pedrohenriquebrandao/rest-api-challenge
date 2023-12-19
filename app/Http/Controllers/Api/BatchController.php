<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Batch;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $batches = Batch::all();

        return response()->json([
            'batches: ' => $batches,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'label' => ['required'],
            'expiration_date' => ['required'],
        ]);

        $batch = Batch::create($input);

        if ($batch->save()) {
            return response()->json([
                'message: ' => 'Batch created!',
            ], 200);
        } else {
            return response([
                'message: ' => 'Batch not created.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $batch = Batch::find($id);

        if (is_null($batch)) {
            return response()->json([
                "message" => "Batch not found!"
            ], 500);
        }

        return response()->json([
            'batch: ' => $batch
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $batch = Batch::find($id);

        if ($batch) {
            $input = $request->validate([
                'label' => ['required'],
                'expiration_date' => ['required'],
            ]);

            $batch->label = $input['label'];
            $batch->expiration_date = $input['expiration_date'];

            if ($batch->save()) {
                return response()->json([
                    'message: ' => 'Batch updated!',
                    'batch: ' => $batch
                ], 200);
            } else {
                return response([
                    'message: ' => 'Batch not updated!',
                ], 500);
            }
        } else {
            return response([
                'message: ' => 'Batch not found!',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $batch = Batch::find($id);

        if ($batch) {
            $batch->delete();

            return response()->json([
                'message: ' => 'Batch deleted!',
            ], 200);
        } else {
            return response([
                'message: ' => 'Batch not found!',
            ], 500);
        }
    }
}
