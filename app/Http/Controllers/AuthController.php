<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        try{
            
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);
    
            $user = User::where('email', $request->email)->first();
    
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json(['message' => 'Invalid credentials'], 401);
            }
    
            $token = $user->createToken('auth_token')->plainTextToken;
            
            return response()->json(['token' => $token], 200);
            
        }catch (\Exception $e) {
            // Log the error
            \Log::error('Error occurred: ' . $e->getMessage());

            // You can also return a custom error response
            return response()->json([
                'error' => 'An error occurred. Please try again later.',
                'details' => $e->getMessage() // Aquí se incluye el detalle del error
            ], 500);
        }
        
    }
}
