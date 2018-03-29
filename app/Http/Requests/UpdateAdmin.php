<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class UpdateAdmin extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'signup_token' => 'required|string',
            'name' => 'required|string|min:5|max:255',            
            'email' => 'required|string|email|max:255',
            'password' => 'required|string',
            'sell_url' => 'required|unique:users'
        ];
    }

    public function consist() {
        $user = User::where('signup_token', request('signup_token'));

        if ($user->first()['email'] != request('email') && User::where('email', request('email'))->exists()) {
            return back()->withErrors(['email' => 'not_unique']);
        }

        switch($user->first()['role']) {
            case 0:
                $role = 2;
                break;
            case 10:
                $role = 1;
                break;
            case 30:
                $role = 3;
        }

        if ($user) {
            $user->update([
                'name' => request('name'),            
                'email' => request('email'),
                'password' => bcrypt(request('password')),
                'sell_url' => request('sell_url'),
                'signup_token' => NULL,
                'role' => $role
            ]);
        }

    }
}
