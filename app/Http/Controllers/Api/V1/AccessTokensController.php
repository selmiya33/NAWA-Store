<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccessTokensController extends Controller
{
    //

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'nullable',
            'abillities' => 'array'
        ]);
        $user = User::where('email', '=', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $name = $request->input('device_name', $request->userAgent());
            $token = $user->createToken($name, $request->input('abillities', ['*']), now()->addDays(30));

            return response([
                'access_token' => $token->plainTextToken,
                'user' => $user
            ]);
        }

        return response([
            'message' => 'Invalid creadentials'
        ], 401);
    }

    //Revoke
    public function destroy()
    {
        $user = Auth::guard('sanctum')->user();
        //delete current Access Token (logout from  cureent device)
        $user->currentAccessToken()->delete();

        return response([], 204);

        //delete all tokens (logout from  all devices)
        // $user->tokens()->delete();
    }
}
