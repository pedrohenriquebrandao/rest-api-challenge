<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupons = Coupon::all();

        return response()->json([
            'coupons: ' => $coupons,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'label' => ['required'],
            'discount_percentage' => ['required'],
        ]);

        $coupon = Coupon::create($input);

        if ($coupon->save()) {
            return response()->json([
                'message: ' => 'Coupon created!',
            ], 200);
        } else {
            return response([
                'message: ' => 'Coupon not created.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $coupon = Coupon::find($id);

        if (is_null($coupon)) {
            return response()->json([
                "message" => "Coupon not found!"
            ], 500);
        }

        return response()->json([
            'coupon: ' => $coupon
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $coupon = Coupon::find($id);

        if ($coupon) {
            $input = $request->validate([
                'label' => ['required'],
                'discount_percentage' => ['required'],
            ]);

            $coupon->label = $input['label'];
            $coupon->discount_percentage = $input['discount_percentage'];

            if ($coupon->save()) {
                return response()->json([
                    'message: ' => 'Coupon updated!',
                    'coupon: ' => $coupon
                ], 200);
            } else {
                return response([
                    'message: ' => 'Coupon not updated!',
                ], 500);
            }
        } else {
            return response([
                'message: ' => 'Coupon not found!',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);

        if ($coupon) {
            $coupon->delete();

            return response()->json([
                'message: ' => 'Coupon deleted!',
            ], 200);
        } else {
            return response([
                'message: ' => 'Coupon not found!',
            ], 500);
        }
    }
}
