<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::all();

        return response()->json([
            'tickets: ' => $tickets,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'price' => ['required'],
            'producer_id' => ['required'],
            'event_id' => ['required'],
            'sector_id' => ['required'],
            'batch_id' => ['required'],
            'coupon_id' => ['required']
        ]);

        $ticket = Ticket::create($input);

        if ($ticket->save()) {
            return response()->json([
                'message: ' => 'Ticket created!',
            ], 200);
        } else {
            return response([
                'message: ' => 'Ticket not created.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $ticket = Ticket::find($id);

        if (is_null($ticket)) {
            return response()->json([
                "message" => "Ticket not found!"
            ], 500);
        }

        return response()->json([
            'ticket: ' => [
                'price' => $ticket->price,
                'producer' => $ticket->producer->name,
                'event' => $ticket->event->name,
                'sector' => $ticket->sector->label,
                'batch' => $ticket->batch->label,
                'coupon' => $ticket->coupon->label,
            ]
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $ticket = Ticket::find($id);

        if ($ticket) {
            $input = $request->validate([
                'price' => ['required'],
                'producer_id' => ['required'],
                'event_id' => ['required'],
                'sector_id' => ['required'],
                'batch_id' => ['required'],
                'coupon_id' => ['required']
            ]);

            $ticket->label = $input['price'];
            $ticket->producer_id = $input['producer_id'];
            $ticket->event_id = $input['event_id'];
            $ticket->sector_id = $input['sector_id'];
            $ticket->batch_id = $input['batch_id'];
            $ticket->coupon_id = $input['coupon_id'];

            if ($ticket->save()) {
                return response()->json([
                    'message: ' => 'Ticket updated!',
                    'coupon: ' => $ticket
                ], 200);
            } else {
                return response([
                    'message: ' => 'Ticket not updated!',
                ], 500);
            }
        } else {
            return response([
                'message: ' => 'Ticket not found!',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $ticket = Ticket::find($id);

        if ($ticket) {
            $ticket->delete();

            return response()->json([
                'message: ' => 'Ticket deleted!',
            ], 200);
        } else {
            return response([
                'message: ' => 'Ticket not found!',
            ], 500);
        }
    }
}
