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
		$role = Auth::user()->role;
		$grade_total = 0;

		// Self total
		$tickets_self = Ticket::where('student_id', Auth::user()->id)->get();
		$self_total = 0;
		foreach ($tickets_self as $ticket) {
			if ($ticket->type === 1) {
				$price = 350;
			} else if ($ticket->type === 2) {
				$price = 500;
			} else {
				return;
			}

			$self_total += $price;
		}

		// Grade total
		$tickets = Ticket::with('users')->get();
		$totals = [];
		foreach($tickets as $ticket) {
			$grade = $ticket->users->grade;

			if ($ticket->type === 1) {
				$price = 350;
			} else if ($ticket->type === 2) {
				$price = 500;
			} else {
				return;
			}

			if (isset($totals[$grade])) {
				$totals[$grade] += $price;
			} else {
				$totals[$grade] = $price;
			}
		}

		// Latest tickets sold
		$latest_tickets_raw = Ticket::where('student_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
		$latest_collection = [];
		$latest_tickets = [];

		foreach ($latest_tickets_raw as $ticket) {
			if (isset($latest_tickets[$ticket->group])) {
				$latest_tickets[$ticket->group]['num'] += 1;
			} else {
				$latest_tickets[$ticket->group] = [
					'name' => $ticket->name,
					'num' => 1
				];
			}
		}

		// Featured peers
		$featured_peers = User::where(['grade' => Auth::user()->grade])->where('role', '!=', 0)->with('tickets')->orderBy('name')->limit(3)->get();

		return view('student-panel.startpanel')->with([
			'role' => $role,
			'totals' => $totals,
			'self_total' => $self_total,
			'latest_tickets' => array_slice($latest_tickets, 0, 3),
			'featured_peers' => $featured_peers
		]);
	}

	public function showCreateUser() {
		$role = Auth::user()['role'];

		switch($role) {
			case 1:
				return view('admin-panel.createuser', compact('role'));
				break;
			case 2:
				return redirect('/admin');
				break;
			case 3:
				return view('student-panel.createuser', compact('role'));
		}

	}

	public function update(Update $form) {
		$form->consist();
		Auth::attempt(['email' => request('email'), 'password' => request('password')]);

		return redirect('/admin');
	}

	/* ----- Panel Pages ----- */
	public function latest() {
		$role = Auth::user()['role'];
		$tickets = Ticket::where('student_id', Auth::user()['id'])->orderBy('updated_at', 'DESC')->get();

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

		return view('student-panel.latest', compact('groups', 'role'));
	}

	public function classList() {
		$users = User::where('grade', Auth::user()->grade)->orderBy('name')->with('tickets')->get();

		foreach ($users as $key => $user) {
			$users[$key]['sold_for'] = 0;

			foreach ($user->tickets as $ticket) {
				if ($ticket->type === 1) {
					$users[$key]['sold_for'] += 350;
				} else if ($ticket->type === 2) {
					$users[$key]['sold_for'] += 500;
				}
			}
		}

		return view('student-panel.classlist', compact('users'))->with([
			'role' => Auth::user()->role
		]);
	}

}
