<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Client;
use App\Models\Producer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Response;

// 6|9lxaO1CPBKWRDoHn1BaGcDjcVD1ynPNBzppgEVEm7096e81f

class AuthController extends Controller
{
    public function clientLogin(Request $request) {

        $client = Client::where('socialNumber', $request->socialNumber)->first();

        if ($client && Hash::check($request->password, $client->password)) {
          $token =  $client->createToken('client-token', expiresAt:now()->addDay())->plainTextToken;

          return response()->json([
            'token' => $token
          ]);
        } else {
            return response('Not Authorized', 403);
        }
    }

    public function adminLogin(Request $request) {

        $admin = Admin::where('socialNumber', $request->socialNumber)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {
          $token =  $admin->createToken('admin-token', expiresAt:now()->addDay())->plainTextToken;

          return response()->json([
            'token' => $token
          ]);
        } else {
            return response('Not Authorized', 403);
        }
    }

    public function producerLogin(Request $request) {

        $producer = Producer::where('socialNumber', $request->socialNumber)->first();

        if ($producer && Hash::check($request->password, $producer->password)) {
          $token =  $producer->createToken('producer-token', expiresAt:now()->addDay())->plainTextToken;

          return response()->json([
            'token' => $token
          ]);
        } else {
            return response('Not Authorized', 403);
        }
    }
}
