<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Notifications\CustomVerifyEmailNotification;

class StoreCenterController extends Controller
{
    public function create()
    {
        return inertia('StoreCenter');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'no' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
            'id_upload' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $idPath = $request->file('id_upload')->store('ids', 'public');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'no' => $request->no,
            'password' => Hash::make($request->password),
            'id_upload' => $idPath,
            'is_moderator' => false,
            'status' => 'pending',
            'otp' => $this->generateOtp(),
        ]);

        $this->sendOtp($user->no, $user->otp);

        $user->notify(new CustomVerifyEmailNotification($user));

        return redirect()->route('login')->with('success', 'Registration successful! Please check your email and phone for verification.');
    }

    private function generateOtp()
    {
        return rand(100000, 999999);
    }

    private function sendOtp($phoneNumber, $otp)
    {
        // Integrate with an SMS service provider to send OTP
    }

    public function verifyOtp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'otp' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = User::find($request->user_id);

        if ($user->otp == $request->otp) {
            $user->is_moderator = true;
            $user->status = 'active';
            $user->otp = null;
            $user->save();

            return response()->json(['message' => 'Verification successful!'], 200);
        } else {
            return response()->json(['error' => 'Invalid OTP'], 400);
        }
    }
}