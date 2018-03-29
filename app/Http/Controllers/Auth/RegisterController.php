<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{

    use RegistersUsers;

    protected $redirectTo = '/admin';

    public function __construct() {
        $this->middleware('guest');
    }

    public function showRegistrationForm($token) {
        $user = User::where('signup_token', $token)->first();
        if (!$user) { return; }
        $t = $user['role'];

        if ($t == 0 || $t == 10 || $t == 30) {
            return view('auth.create', ['email' => $user['email'], 'token' => $token, 'role' => $user['role']]);
        } else {
            return view('auth.badlink');
        }
    }

    protected function validator(array $data) {
        return Validator::make($data, [
            'email' => 'required|string|email|max:255|unique:users'
        ]);
    }

    protected function create(array $data) {

        // return User::create([
        //     'name' => $data['name'],
        //     'email' => $data['email'],
        //     'password' => Hash::make($data['password']),
        // ]);

    }
}
