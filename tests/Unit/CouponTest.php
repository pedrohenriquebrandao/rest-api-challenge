<?php

namespace Tests\Unit;

use App\Models\Coupon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class CouponTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;

    public function test_coupon_create(): void
    {
        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->post('/api/coupons', [ 
            'label' => 'Coupon label',
            'discount_percentage' => '10',
        ]);

        $response->assertStatus(200);   
    }

    public function test_coupon_list(): void
    {
        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->get('/api/coupons', [ 
            'label' => 'Coupon label',
            'discount_percentage' => '10',
        ]);

        $response->assertStatus(200);   
    }

    public function test_coupon_list_by_id(): void
    {   
        $coupon = new Coupon();
        
        $coupon->label = 'Coupon label';
        $coupon->discount_percentage = '10';

        $coupon->save();

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->get('/api/coupons/' . $coupon->id, [ 
            'label' => 'Coupon label',
            'discount_percentage' => '10',
        ]);

        $response->assertStatus(200);   
    }

    public function test_coupon_delete(): void
    {   
        $coupon = new Coupon();
        
        $coupon->label = 'Coupon label';
        $coupon->discount_percentage = '10';

        $coupon->save();

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->delete('/api/coupons/' . $coupon->id, [ 
            'label' => 'Coupon label',
            'discount_percentage' => '10',
        ]);

        $response->assertStatus(200);   
    }

    public function test_coupon_update(): void
    {   
        $coupon = new Coupon();
        
        $coupon->label = 'Coupon label';
        $coupon->discount_percentage = '10';

        $coupon->save();

        $response = $this->withHeaders([
            "Accept"=>"application/json"
        ])->put('/api/coupons/' . $coupon->id, [ 
            'label' => 'Coupon label',
            'discount_percentage' => '20',
        ]);

        $response->assertStatus(200);   
    }
}