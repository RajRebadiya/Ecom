<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user_data;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //
    public function register(Request $req)
    {
        // Validate incoming request data
        $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new user instance
        $user = new user_data();
        $user->name = $req->input('name');
        $user->email = $req->input('email');
        $user->password = Hash::make($req->input('password')); // Hash the password
        $user->save();

        return redirect('login')->with(['success' => 'Regisration successfull.', 'data' => $user]);
    }

    public function login(Request $req)
    {
        // Validate input fields
        $validator = Validator::make($req->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return redirect('login')->withErrors($validator)->withInput();
        }

        $email = $req->input('email');
        $password = $req->input('password');

        // Find the user by email
        $user = user_data::where('email', $email)->first();

        // Check if the user exists and if the password is correct
        if ($user && Hash::check($password, $user->password)) {
            session(['email' => $user->email]); // Storing email in session

            // Check if there's an intended URL in the session
            if (session()->has('intended_url')) {
                $intendedUrl = session('intended_url');
                session()->forget('intended_url'); // Remove intended URL from session
                return redirect($intendedUrl)->with(['success' => 'Login successful.', 'data' => $user]);
            }

            return redirect('home')->with(['success' => 'Login successful.', 'data' => $user]);
        } else {
            return redirect('login')->with(['errors' => 'Invalid email or password.']);
        }
    }

    public function logout()
    {
        session()->forget('email'); // Remove email from session
        return redirect('login')->with(['success' => 'Logout successful.']);
    }
}
