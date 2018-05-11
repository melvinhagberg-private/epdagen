<?php

namespace App\Http\Controllers;

use App\Http\Requests\Type;
use App\Http\Requests\TicketInfo;
use App\Payment;
use App\User;
use Auth;
use App\Ticket;

class TicketController extends Controller {
	private $payment;

    public function __construct(Payment $pay) {
        $this->Payment = $pay;
    }

	public function index() {
		if (isset($ses['products'])) {
			return redirect('/biljett/betala');
		} else {
			return redirect('/biljett/uppgifter');
		}
	}

	/* ----- Step 1: Info ----- */
	public function viewInfo($path = NULL) {
		$name = 'Uppgifter';

		if ($path !== NULL) {
			$student = User::where('sell_url', $path)->first();
			if ($student) {
				session()->flash('student', $student);
				$affiliate = $student;
			} else {
				return redirect('/biljett/uppgifter');
			}

		} else if ($affiliate = session('student')) {
			session()->reflash('student');
			$affiliate = session('student');
		}

		if (!isset($affiliate)) {
			$students = User::orderBy('grade')->where('role', 2)->orWhere('role', 3)->get();
			$grades = User::selectRaw('COUNT(id), grade')->groupBy('grade')->get();
			$affiliate = false;
		}

		if (!$affiliate) {
			foreach ($grades as $index => $grade) {
				if ($grade['grade'] == 'NOINDEX') {
					unset($grades[$index]);
					break;
				}
			}
		}

		return view('client-ticket.info.index', compact('name', 'affiliate', 'students', 'grades'));
	}

	public function store(TicketInfo $form) {
		return $form->consist();
	}

	/* ----- Step 2: Payment ----- */
	public function viewPayment() {
		if (!session()->has('client.products')) {
			return redirect('/');
		}

		$paymentHref = Payment::init(session('client'));

		$name = 'Betala';

		return view('client-ticket.payment.index', compact('paymentHref', 'name'));
	}

	/* ----- Step 3: Confirmation ----- */
	public function confirmation() {
		return $this->Payment->store();
	}

	/* ----- Admin only: Validate ticket ----- */
	public function ticketValid($ticket_id) {
		// if (!$user = Auth::user()) {
		// 	return redirect(url('/biljett/' . $ticket_id . '.pdf'));
        // }

        $query = Ticket::where('ticket_id', $ticket_id);
		$ticket = $query->first();

        if ($ticket) {
			if (!$ticket['used']) {
				$query->update(['used' => true]);
				return view('ticketValid.valid')->with(['name' => $ticket['name'], 'email' => $ticket['email'], 'ticket_id' => $ticket['ticket_id']]);

			} else {
				return view('ticketValid.used')->with(['name' => $ticket['name'], 'email' => $ticket['email'], 'ticket_id' => $ticket['ticket_id']]);
			}
        } else {
            return view('ticketValid.invalid');
        }
	}

	public function ticketRegret($ticket_id) {
		// if (!$user = Auth::user()) {
		// 	return redirect(url('/biljett/' . $ticket_id . '.pdf'));
        // }

		$query = Ticket::where('ticket_id', $ticket_id)->update(['used' => false]);
		return 'Åtgärd ångrad';
	}

}
