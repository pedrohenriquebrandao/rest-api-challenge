<?php

namespace Tests\Unit;

use App\Models\Producer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ProducerTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function test_producer_login(): void {
        
        $producer = new Producer();
        
        $producer->name = 'Producer name';
        $producer->phone = '999991111';
        $producer->socialNumber = '12312312311';
        $producer->password = bcrypt('password');

        $producer->save();

        $response = $this->post('api/producer/login', [
            'socialNumber' => '12312312311',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_producer_list(): void
    {
        $producer = new Producer();
        
        $producer->name = 'Producer name';
        $producer->phone = '999991111';
        $producer->socialNumber = '12312312311';
        $producer->password = bcrypt('password');

        $producer->save();
        
        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->get('/api/producers', [ 
            'name' => 'Producer name',
            'phone' => '999991111',
            'socialNumber' => '12312312311',
            'password' => 'password',
        ]);

        $response->assertStatus(200);   
    }

    public function test_producer_list_by_id(): void
    {   
        $producer = new Producer();
        
        $producer->name = 'producer name';
        $producer->phone = '999991111';
        $producer->socialNumber = '12312312311';
        $producer->password = bcrypt('password');

        $producer->save();

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->get('/api/producers/' . $producer->id, [ 
            'name' => 'Producer name',
            'phone' => '999991111',
            'socialNumber' => '12312312311',
            'password' => 'password',
        ]);

        $response->assertStatus(200);   
    }

    public function test_producer_delete(): void
    {   
        $producer = new Producer();
        
        $producer->name = 'Producer name';
        $producer->phone = '999991111';
        $producer->socialNumber = '12312312311';
        $producer->password = bcrypt('password');

        $producer->save();

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->delete('/api/producers/' . $producer->id, [ 
            'name' => 'Producer name',
            'phone' => '999991111',
            'socialNumber' => '12312312311',
            'password' => 'password',
        ]);

        $response->assertStatus(200);   
    }

    public function test_producer_update(): void
    {   
        $producer = new Producer();
        
        $producer->name = 'Producer name';
        $producer->phone = '999991111';
        $producer->socialNumber = '12312312311';
        $producer->password = bcrypt('password');

        $producer->save();

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->put('/api/producers/' . $producer->id, [ 
            'name' => 'Producer name',
            'phone' => '999992222',
            'socialNumber' => '12312312311',
            'password' => 'password',
        ]);

        $response->assertStatus(200);   
    }
}