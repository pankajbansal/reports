<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Facades\LogActivity;

class UserController extends Controller
{
    // Handle user login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        // dd($credentials);
        if (Auth::attempt($credentials)) {
            // Log the activity
            $this->logUserActivity(Auth::user()->id, 'Login', 'User logged in successfully.');

            activity()->log( Auth::user()->email . ' User logged in.');
            return response()->json(['message' => 'Login successful'], 200);
            
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Handle user logout
    public function logout()
    {
        $userId = Auth::id();
        Auth::logout();

        // Log the activity
        $this->logUserActivity($userId, 'logout', 'User logged out successfully.');
        activity()->log( Auth::user()->email . ' User logged out.');

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

    // Update the user profile
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        
        // Validation for profile update
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Update the user profile
        $user->name = $request->name;
        $user->email = $request->email;
        
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        activity()->log( Auth::user()->email . ' User Profile Updated.');
        // Log the activity
        $this->logUserActivity($user->id, 'Profile Update', 'User updated their profile.');

        return response()->json(['message' => 'Profile updated successfully'], 200);
    }

    // Log the activity in user_activities table
    private function logUserActivity($userId, $activityName, $description)
    {
        UserActivity::create([
            'user_id' => $userId,
            'activity_name' => $activityName,
            'description' => $description,
            'ip_address' => request()->ip(),
            'created_at' => now(),
        ]);
    }
}
