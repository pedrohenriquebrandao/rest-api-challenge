<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = Admin::all();

        return response()->json([
            'admins: ' => $admins,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => ['required'],
            'phone' => ['required'],
            'socialNumber' => ['required'],
            'password' => ['required'],
        ]);

        $input['password']= bcrypt($input['password']);
        $admin = Admin::create($input);

        $admin->assignRole('admin');

        if($admin->save()) {
            return response()->json([
                'message: ' => 'Admin created!',
            ], 200);
        } else {
            return response([
                'message: ' => 'Admin not created.',
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $admin = Admin::find($id);

        if(is_null($admin)) {
            return response()->json([
                "message" => "Admin not found!"
            ], 500);
        }

        return response()->json([
            'admin: ' => $admin
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $admin = Admin::find($id);

        if($admin){
           $input = $request->validate([
              'name' => ['required'],
              'phone' => ['required'],
              'socialNumber' => ['required'],
              'password' => ['required'],
            ]);

            $admin->name = $input['name'];
            $admin->phone = $input['phone'];
            $admin->socialNumber = $input['socialNumber'];
            $admin->password = $input['password'];

            if($admin->save()){
                return response()->json([
                    'message: ' => 'Admin updated!',
                    'admin: ' => $admin
                ], 200);
            }else {
                return response([
                    'message: ' => 'Admin not updated!',
                ], 500);
            }
        } else {
            return response([
                'message: ' => 'Admin not found!',
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);

        if($admin){
            $admin->delete();

            return response()->json([
                'message: ' => 'Admin deleted!',
            ], 200);
        } else {
            return response([
                'message: ' => 'Admin not found!',
            ], 500);
        }
    }
}
