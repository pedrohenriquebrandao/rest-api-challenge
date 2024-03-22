<?php

namespace Tests\Unit;

use App\Models\Event;
use App\Models\Producer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function test_event_create(): void
    {
        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->post('/api/events', [ 
            'name' => 'Event name',
            'city' => 'Event city',
            'location' => 'Event location',
            'banner' => 'Event banner',
            'producer_id' => '1',
        ]);

        $response->assertStatus(200);   
    }

    public function test_event_list(): void
    {
        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->get('/api/events', [ 
            'name' => 'Event name',
            'city' => 'Event city',
            'location' => 'Event location',
            'banner' => 'Event banner',
            'producer_id' => '1',
        ]);

        $response->assertStatus(200);   
    }

    public function test_event_list_by_id(): void
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

       // ------------------------------------------

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->get('/api/events/' . $event->id , [ 
            'name' => 'Event name',
            'city' => 'Event city',
            'location' => 'Event location',
            'banner' => 'Event banner',
            'producer' => 'Producer name',
        ]);

        $response->assertStatus(200);   
    }

    public function test_event_delete(): void
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

       // ------------------------------------------

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->delete('/api/events/' . $event->id , [ 
            'name' => 'Event name',
            'city' => 'Event city',
            'location' => 'Event location',
            'banner' => 'Event banner',
            'producer' => 'Producer name',
        ]);

        $response->assertStatus(200);   
    }

    public function test_event_update(): void
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

       // ------------------------------------------

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->put('/api/events/' . $event->id , [ 
            'name' => 'Event name',
            'city' => 'Event city',
            'location' => 'Event location',
            'banner' => 'Event banner new',
            'producer_id' => $producer->id,
        ]);

        $response->assertStatus(200);   
    }
}