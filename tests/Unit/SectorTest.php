<?php

namespace Tests\Unit;

use App\Models\Producer;
use App\Models\Sector;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class SectorTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function test_sector_create(): void
    {   
        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->post('/api/sectors', [ 
            'label' => 'Sector label',
        ]);

        $response->assertStatus(200);   
    }

    public function test_sector_list(): void
    {
        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->get('/api/sectors', [ 
            'label' => 'Sector label',
        ]);

        $response->assertStatus(200);   
    }

    public function test_sector_list_by_id(): void
    {   
        $sector = new Sector();
        
        $sector->label = 'Sector label';

        $sector->save();

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->get('/api/sectors/' . $sector->id, [ 
            'label' => 'Sector label',
        ]);

        $response->assertStatus(200);   
    }

    public function test_sector_delete(): void
    {   
        $sector = new Sector();
        
        $sector->label = 'Sector label';

        $sector->save();

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->delete('/api/sectors/' . $sector->id, [ 
            'label' => 'Sector label',
        ]);

        $response->assertStatus(200);   
    }

    public function test_sector_update(): void
    {   
        $sector = new Sector();
        
        $sector->label = 'Sector label';

        $sector->save();

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->put('/api/sectors/' . $sector->id, [ 
            'label' => 'Sector label new',
        ]);

        $response->assertStatus(200);   
    }

}