<?php

namespace Tests\Unit;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function test_client_login(): void {
        $client = new Client();
        
        $client->name = 'Client name';
        $client->phone = '999991111';
        $client->socialNumber = '12312312311';
        $client->password = bcrypt('password');

        $client->save();

        $response = $this->post('api/client/login', [
            'socialNumber' => '12312312311',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_client_list(): void
    {
        $client = new Client();
        
        $client->name = 'Client name';
        $client->phone = '999991111';
        $client->socialNumber = '12312312311';
        $client->password = bcrypt('password');

        $client->save();
        
        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->get('/api/clients', [ 
            'name' => 'Client name',
            'phone' => '999991111',
            'socialNumber' => '12312312311',
            'password' => 'password',
        ]);

        $response->assertStatus(200);   
    }

    public function test_client_list_by_id(): void
    {   
        $client = new Client();
        
        $client->name = 'client name';
        $client->phone = '999991111';
        $client->socialNumber = '12312312311';
        $client->password = bcrypt('password');

        $client->save();

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->get('/api/clients/' . $client->id, [ 
            'name' => 'Client name',
            'phone' => '999991111',
            'socialNumber' => '12312312311',
            'password' => 'password',
        ]);

        $response->assertStatus(200);   
    }

    
    public function test_client_delete(): void
    {   
        $client = new Client();
        
        $client->name = 'client name';
        $client->phone = '999991111';
        $client->socialNumber = '12312312311';
        $client->password = bcrypt('password');

        $client->save();

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->delete('/api/clients/' . $client->id, [ 
            'name' => 'Client name',
            'phone' => '999991111',
            'socialNumber' => '12312312311',
            'password' => 'password',
        ]);

        $response->assertStatus(200);   
    }

    public function test_client_update(): void
    {   
        $client = new Client();
        
        $client->name = 'client name';
        $client->phone = '999991111';
        $client->socialNumber = '12312312311';
        $client->password = bcrypt('password');

        $client->save();

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->put('/api/clients/' . $client->id, [ 
            'name' => 'Client name',
            'phone' => '999992222',
            'socialNumber' => '12312312311',
            'password' => 'password',
        ]);

        $response->assertStatus(200);   
    }
}