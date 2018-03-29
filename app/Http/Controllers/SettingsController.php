<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\User;
use App\Mail\RegisterStudent;

class SettingsController extends Controller {
	public function do() {		
		if (!isset($_GET['action'])) { return; }
		$ac = $_GET['action'];

		$role = Auth::user()['role'];

		switch($role) {
			case 1:
				if ($ac == 'add_users') {
					$userList = [];
					foreach(request('email_list') as $user) {
						array_push($userList, [
							'role' => $user['type'] * 10,
							'grade' => $user['grade'],
							'email' => $user['email'],
							'signup_token' => md5($user['email'])
						]);
						Mail::to($user['email'])->send(new RegisterStudent(md5($user['email'])));
					}

					User::insert($userList);
				}
				
				break;

			case 3:
				if ($ac == 'add_users') {
					$emailList = [];
					foreach(request('email_list') as $email) {
						array_push($emailList, [
							'grade' => 'EP18',
							'email' => $email,
							'signup_token' => md5($email)
						]);
						Mail::to($email)->send(new RegisterStudent(md5($email)));
					}

					User::insert($emailList);
				}

				break;
		}

	}
}
