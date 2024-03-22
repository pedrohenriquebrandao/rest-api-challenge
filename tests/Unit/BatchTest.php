<?php

namespace Tests\Unit;

use App\Models\Batch;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class BatchTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function test_batch_create(): void
    {
        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->post('/api/batches', [ 
            'label' => 'Batch label',
            'expiration_date' => '2024-03-30',
        ]);

        $response->assertStatus(200);   
    }

    public function test_batch_list(): void
    {
        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->get('/api/batches', [ 
            'label' => 'Batch label',
            'expiration_date' => '2024-03-30',
        ]);

        $response->assertStatus(200);   
    }

    public function test_batch_list_by_id(): void
    {   
        $batch = new Batch();
        
        $batch->label = 'Batch label';
        $batch->expiration_date = '2024-03-30';

        $batch->save();

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->get('/api/batches/' . $batch->id, [ 
            'label' => 'Batch label',
            'expiration_date' => '2024-03-30',
        ]);

        $response->assertStatus(200);   
    }

    public function test_batch_delete(): void
    {   
        $batch = new Batch();
        
        $batch->label = 'Batch label';
        $batch->expiration_date = '2024-03-30';

        $batch->save();

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->delete('/api/batches/' . $batch->id, [ 
            'label' => 'Batch label',
            'expiration_date' => '2024-04-30',
        ]);

        $response->assertStatus(200);   
    }

    public function test_batch_update(): void
    {   
        $batch = new Batch();
        
        $batch->label = 'Batch label';
        $batch->expiration_date = '2024-03-30';

        $batch->save();

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->put('/api/batches/' . $batch->id, [ 
            'label' => 'Batch label',
            'expiration_date' => '2024-04-30',
        ]);

        $response->assertStatus(200);   
    }
}