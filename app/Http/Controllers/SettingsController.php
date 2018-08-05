<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\User;
use App\Jobs\InviteMailJob;

class SettingsController extends Controller {
	public function do() {
		if (!isset($_GET['action'])) { return; }
		$ac = $_GET['action'];

		$role = Auth::user()['role'];

		switch($role) {
			case 1:
				if ($ac == 'add_users') {
					$userList = [];
					$errors = [];
					foreach(request('email_list') as $user) {
						if (User::where('email', $user['email'])->exists()) {
							array_push($errors, $user['email'] . ' är redan tagen.');
							continue;
						}

						array_push($userList, [
							'role' => $user['type'] * 10,
							'grade' => $user['grade'],
							'email' => $user['email'],
							'signup_token' => md5($user['email'])
						]);

						$job = ((new InviteMailJob($user['email'], Auth::user()))->delay(now()->addSeconds(1)));
						dispatch($job);
					}

					User::insert($userList);
				}

				break;

			case 3:
				if ($ac == 'add_users') {
					$emailList = [];
					$errors = [];
					foreach(request('email_list') as $email) {
						if (User::where('email', $email)->exists()) {
							array_push($errors, $email . ' är redan tagen.');
							continue;
						}

						array_push($emailList, [
							'grade' => 'EP18',
							'email' => $email,
							'signup_token' => md5($email)
						]);

						$job = ((new InviteMailJob($email, Auth::user()->name))->delay(now()->addSeconds(1)));
						dispatch($job);
					}

					User::insert($emailList);

					if ($errors) {
						return $errors;
					} else {
						return 'success';
					}
				}

				break;
		}

	}
}
