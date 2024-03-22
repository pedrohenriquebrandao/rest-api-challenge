<?php

namespace Tests\Unit;

use App\Models\Batch;
use App\Models\Coupon;
use App\Models\Event;
use App\Models\Producer;
use App\Models\Sector;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class TicketTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function test_ticket_create(): void
    {
        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->post('/api/tickets', [ 
            'client_id' => '1',
            'price' => '100',
            'producer_id' => '1',
            'event_id' => '1',
            'sector_id' => '1',
            'batch_id' => '1',
            'coupon_id' => '1',
        ]);

        $response->assertStatus(200);   
    }

    public function test_ticket_list(): void
    {
        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->get('/api/tickets', [ 
            'client_id' => '1',
            'price' => '100',
            'producer_id' => '1',
            'event_id' => '1',
            'sector_id' => '1',
            'batch_id' => '1',
            'coupon_id' => '1',
        ]);

        $response->assertStatus(200);   
    }

    public function test_ticket_list_by_id(): void
    {   
        $producer = new Producer();
        
        $producer->name = 'Producer name';
        $producer->phone = '999991111';
        $producer->socialNumber = '12312312311';
        $producer->password = bcrypt('password');

        $producer->save();

        //------------------------------------------

        $event = new Event();
        
        $event->name = 'Event name';
        $event->city = 'Event city';
        $event->location = 'Event location';
        $event->banner = 'Event banner';
        $event->producer_id = $producer->id;

        $event->save();

        //------------------------------------------

        $sector = new Sector();
        
        $sector->label = 'Sector label';

        $sector->save();

        //------------------------------------------

        $batch = new Batch();
        
        $batch->label = 'Batch label';
        $batch->expiration_date = '2024-03-30';

        $batch->save();

        //------------------------------------------

        $coupon = new Coupon();
        
        $coupon->label = 'Coupon label';
        $coupon->discount_percentage = '10';

        $coupon->save();

        //------------------------------------------

        $ticket = new Ticket();
        
        $ticket->client_id = '1';
        $ticket->price = '100';
        $ticket->producer_id = $producer->id;
        $ticket->event_id = $event->id;
        $ticket->sector_id = $sector->id;
        $ticket->batch_id = $batch->id;
        $ticket->coupon_id = $coupon->id;

        $ticket->save();

        //------------------------------------------

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->get('/api/tickets/' . $ticket->id, [ 
            'price' => '100',
            'producer' => $producer->id,
            'event' => $event->id,
            'sector' => $sector->id,
            'batch' => $batch->id,
            'coupon' => $coupon->id,
        ]);

        $response->assertStatus(200);   
    }

    public function test_ticket_delete(): void
    {   
        $producer = new Producer();
        
        $producer->name = 'Producer name';
        $producer->phone = '999991111';
        $producer->socialNumber = '12312312311';
        $producer->password = bcrypt('password');

        $producer->save();

        //------------------------------------------

        $event = new Event();
        
        $event->name = 'Event name';
        $event->city = 'Event city';
        $event->location = 'Event location';
        $event->banner = 'Event banner';
        $event->producer_id = $producer->id;

        $event->save();

        //------------------------------------------

        $sector = new Sector();
        
        $sector->label = 'Sector label';

        $sector->save();

        //------------------------------------------

        $batch = new Batch();
        
        $batch->label = 'Batch label';
        $batch->expiration_date = '2024-03-30';

        $batch->save();

        //------------------------------------------

        $coupon = new Coupon();
        
        $coupon->label = 'Coupon label';
        $coupon->discount_percentage = '10';

        $coupon->save();

        //------------------------------------------

        $ticket = new Ticket();
        
        $ticket->client_id = '1';
        $ticket->price = '100';
        $ticket->producer_id = $producer->id;
        $ticket->event_id = $event->id;
        $ticket->sector_id = $sector->id;
        $ticket->batch_id = $batch->id;
        $ticket->coupon_id = $coupon->id;

        $ticket->save();

        //------------------------------------------

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->delete('/api/tickets/' . $ticket->id, [ 
            'price' => '100',
            'producer' => $producer->id,
            'event' => $event->id,
            'sector' => $sector->id,
            'batch' => '1',
            'coupon' => '1',
        ]);

        $response->assertStatus(200);   
    }

    public function test_ticket_update(): void
    {   
        $producer = new Producer();
        
        $producer->name = 'Producer name';
        $producer->phone = '999991111';
        $producer->socialNumber = '12312312311';
        $producer->password = bcrypt('password');

        $producer->save();

        //------------------------------------------

        $event = new Event();
        
        $event->name = 'Event name';
        $event->city = 'Event city';
        $event->location = 'Event location';
        $event->banner = 'Event banner';
        $event->producer_id = $producer->id;

        $event->save();

        //------------------------------------------

        $sector = new Sector();
        
        $sector->label = 'Sector label';

        $sector->save();

        //------------------------------------------

        $batch = new Batch();
        
        $batch->label = 'Batch label';
        $batch->expiration_date = '2024-03-30';

        $batch->save();

        //------------------------------------------

        $coupon = new Coupon();
        
        $coupon->label = 'Coupon label';
        $coupon->discount_percentage = '10';

        $coupon->save();

        //------------------------------------------

        $ticket = new Ticket();
        
        $ticket->client_id = '1';
        $ticket->price = '100';
        $ticket->producer_id = $producer->id;
        $ticket->event_id = $event->id;
        $ticket->sector_id = $sector->id;
        $ticket->batch_id = $batch->id;
        $ticket->coupon_id = $coupon->id;

        $ticket->save();

        //------------------------------------------

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->put('/api/tickets/' . $ticket->id, [ 
            'price' => '300',
            'producer_id' => $producer->id,
            'event_id' => $event->id,
            'sector_id' => $sector->id,
            'batch_id' => $batch->id,
            'coupon_id' => $coupon->id,
        ]);

        $response->assertStatus(200);   
    }

}