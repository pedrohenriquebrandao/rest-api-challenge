<?php

namespace Tests\Unit;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function test_admin_login(): void {
        
        $admin = new Admin();
        
        $admin->name = 'Admin name';
        $admin->phone = '999991111';
        $admin->socialNumber = '12312312311';
        $admin->password = bcrypt('password');

        $admin->save();

        $response = $this->post('api/admin/login', [
            'socialNumber' => '12312312311',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    public function test_admin_list(): void
    {
        $admin = new Admin();
        
        $admin->name = 'Admin name';
        $admin->phone = '999991111';
        $admin->socialNumber = '12312312311';
        $admin->password = bcrypt('password');

        $admin->save();
        
        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->get('/api/admins', [ 
            'name' => 'Admin name',
            'phone' => '999991111',
            'socialNumber' => '12312312311',
            'password' => 'password',
        ]);

        $response->assertStatus(200);   
    }

    public function test_admin_list_by_id(): void
    {   
        $admin = new Admin();
        
        $admin->name = 'Admin name';
        $admin->phone = '999991111';
        $admin->socialNumber = '12312312311';
        $admin->password = bcrypt('password');

        $admin->save();

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->get('/api/admins/' . $admin->id, [ 
            'name' => 'Admin name',
            'phone' => '999991111',
            'socialNumber' => '12312312311',
            'password' => 'password',
        ]);

        $response->assertStatus(200);   
    }

    public function test_admin_delete(): void
    {   
        $admin = new Admin();
        
        $admin->name = 'Admin name';
        $admin->phone = '999991111';
        $admin->socialNumber = '12312312311';
        $admin->password = bcrypt('password');

        $admin->save();

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->delete('/api/admins/' . $admin->id, [ 
            'name' => 'Admin name',
            'phone' => '999991111',
            'socialNumber' => '12312312311',
            'password' => 'password',
        ]);

        $response->assertStatus(200);   
    }

    public function test_admin_update(): void
    {   
        $admin = new Admin();
        
        $admin->name = 'Admin name';
        $admin->phone = '999991111';
        $admin->socialNumber = '12312312311';
        $admin->password = bcrypt('password');

        $admin->save();

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->put('/api/admins/' . $admin->id, [ 
            'name' => 'Admin name',
            'phone' => '999992222',
            'socialNumber' => '12312312311',
            'password' => 'password',
        ]);

        $response->assertStatus(200);   
    }
}