<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateAdmin as Update;
use App\Ticket;
use App\User;
use Auth;

class AdminController extends Controller {
	public function __construct() {
		$this->middleware('auth')->except('update');
	}

	public function index() {
		$user = Auth::user();
		$peers = User::where('grade', $user['grade'])->get();
		$total = 0;
		
		foreach ($peers as $single) {
			$total += $single['sold_for'];
		}
		
		return view('student-panel.startpanel', compact('user', 'total'));
	}

	public function showCreateUser() {
		$role = Auth::user()['role'];

		switch($role) {
			case 1:
				return view('admin-panel.createuser');
				break;
			case 2:
				return redirect('/admin');
				break;
			case 3:
				return view('student-panel.createuser');
		}
		
	}

	public function update(Update $form) {
		$form->consist();
		Auth::attempt(['email' => request('email'), 'password' => request('password')]);

		return redirect('/admin');
	}
	
	/* ----- Panel Pages ----- */
	public function latest() {
		$tickets = Ticket::where('student_id', Auth::user()['id'])->orderBy('updated_at', 'ASC')->get();

		$groups = array();
		
		foreach ($tickets as $ticket) {
			if ($ticket['group'] == '') {
				$parent = $ticket['ticket_id'];
			} else {
				$parent = $ticket['group'];
			}
			
			if (array_key_exists($parent, $groups)) {
				
				$group = $groups[$parent];
				
				$group['num'] += 1;
				
				if ($ticket['type'] == 1) {
					$group['price'] = $group['num'] * 350;
					$group['nice_type'] = 'privatbiljetter';
				} else if ($ticket['type'] == 2) {
					$group['price'] = $group['num'] * 500;
					$group['nice_type'] = 'företagsbiljetter';
				}
				
				$groups[$parent] = $group;
				
			} else {
				
				if ($ticket['type'] == 1) {
					$price = 300;
					$type = 'privatbiljett';
				} else if ($ticket['type'] == 2) {
					$price = 500;
					$type = 'företagsbiljett';
				}
				
				$groups[$parent] = array(
					'name' => $ticket['name'],
					'email' => $ticket['email'],
					'phone' => $ticket['phone'],
					'num' => 1,
					'type' => $ticket['type'],
					'nice_type' => $type,
					'price' => $price
				);
				
			}
		}
		
		return view('student-panel.latest', compact('groups'));
	}
	
}
