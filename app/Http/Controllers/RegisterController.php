<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QrCodeGenerator;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'qr_code' => 'required|mimes:png,jpg,jpeg,pdf|max:2048', // Accept both images and PDFs
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        // Handle QR code file upload
        $qrCodeFile = $request->file('qr_code');
        $qrCodePath = $qrCodeFile->store('qrcodes', 'public');

        // Create a new user
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'remember_token' => Str::random(10),
            'qr_code' => $qrCodePath,
        ]);

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'qr_code' => $user->qr_code,
            'message' => 'User registered successfully',
        ], 201);
    }
}
