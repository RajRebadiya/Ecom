<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user_data;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendOtp;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

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
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'mobile' => 'required|numeric',
        ]);

        // Create a new user instance
        $user = new user_data();
        $user->name = $req->input('name');
        $user->email = $req->input('email');
        $user->password = Hash::make($req->input('password')); // Hash the password
        $user->state = $req->input('state');
        $user->city = $req->input('city');
        $user->mobile = $req->input('mobile');
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

    public function user_profile()
    {
        $user = user_data::where('email', session('email'))->first();
        // dd($user);

        return view('user_profile', ['user' => $user]);
    }

    public function update_profile(Request $req)
    {
        // dd($req->all());
        $user = user_data::where('email', session('email'))->first();
        $user->name = $req->input('name');
        $user->state = $req->input('state');
        $user->city = $req->input('city');
        $user->mobile = $req->input('mobile');
        // $user->email = $req->input('email');
        $user->save();
        return redirect('user-profile')->with(['success' => 'Profile updated successfully.']);
    }

    public function forget_password(Request $req)
    {
        // dd($req->all());
        $req->validate([
            'email' => 'required|email',
        ]);

        $user = user_data::where('email', $req->email)->first();
        if (!$user) {
            return response()->json([
                'code' => 400,
                'status' => 0,
                'message' => 'User not found'
            ]);
        }
        $otp = random_int(1000, 9999);
        $num = 123;
        Cache::put('otp_' . $num, $otp, now()->addMinutes(5));
        Cache::put('email_' . $num, $user->email, now()->addMinutes(120));

        $email_send = Mail::to($req->email)->send(new SendOtp($otp, $user));
        if ($email_send) {
            return view('verify_password')->with(['success', 'OTP send successfully', 'otp' => $otp]);
        }

    }

    public function verify_otp(Request $req)
    {
        // dd($req->all());

        $otp = $req->input('otp');
        //convert otp into int
        $otp = (int) $otp;
        // dd($otp);
        $num = 123;
        $my_otp = Cache::get('otp_' . $num);
        // dd($my_otp, $otp);
        if ($my_otp == $otp) {
            // dd('jbjd');
            return redirect('change-password')->with(['success' => 'OTP verified successfully.']);
        } else {
            return redirect('verify-password')->with(['error' => 'OTP not verified.']);
        }
    }

    public function change_password()
    {
        return view('set_password');
    }
    public function verify_password()
    {
        return view('verify_password', ['error' => 'Otp is not verified.']);
    }
    public function set_password(Request $request)
    {
        // dd($request->all());
        $user = user_data::where('email', session('email'))->first();
        if (!$user) {
            return redirect('login')->with('error', 'Please login first');
        }
        $user->password = Hash::make($request->input('password'));
        $user->update();
        return redirect('user-profile')->with('success', 'Password Updated Successfully.');
    }
}
