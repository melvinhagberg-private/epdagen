<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Ticket;
use App\User;
use App\PDFgen;
use App\Jobs\TicketMailJob;
use App\Jobs\TicketSoldJob;

class Payment extends Model {

    private $pdfgen;

    public function __construct(PDFgen $pdfgen) {
        $this->PDFgen = $pdfgen;
    }

	public static function init($client) {
		$price = 0;
		foreach ($client['products'] as $prod) {
			$price += $prod['price'];
		}
		$price = strval($price . '.00');

		// Set payid: if it is a group, set to group ID and if single set to ticket ID
		if (session('client.group') !== '') {
			$payid = session('client.group');
			$isgroup = true;
		} else {
			$payid = session('client.products.0.ticket_id');
			$isgroup = false;
		}

		$prop = array(
			"process" => false,
			"secret" => '$2a$10$EOZPTxxNnB5fTy0ai35WE.',
			"merchant_id" => 3711,
			"amount" => $price,
			"payment_ref" => $payid,
			"test" => "test",
			"currency" => "sek",
			"success_url" => "https://epdagen.dev/biljett/tack-for-ditt-kop",
			"error_url" => "https://epdagen.dev/error_swish",
			"customer_ref" => $payid,
			'hash' => md5(3711 . $payid . $payid . $price . 'sek' . 'test' . '$2a$10$EOZPTxxNnB5fTy0ai35WE.')
		);

		$url = 'https://api.mondido.com/v1/transactions';
		$username = '3711';
		$password = '12345';

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_URL,$url);
		curl_setopt($curl, CURLOPT_USERPWD, "$username:$password");

		curl_setopt($curl, CURLOPT_POSTFIELDS, $prop);

		$response = curl_exec($curl);
		$response = json_decode($response, true);
		curl_close($curl);

        if (!isset($response['payment_ref'])) {
            return redirect(url('/biljett/uppgifter'));
        }

		if ($isgroup) {
			Ticket::where('group', $payid)->update(['payment_ref' => $response['payment_ref']]);
		} else {
			Ticket::where('ticket_id', $payid)->update(['payment_ref' => $response['payment_ref']]);
		}

		return $response['href'];
	}

	public function store() {
		$hasGet = (isset($_GET['payment_ref']) && $_GET['status'] === 'approved');

		if ($hasGet) {
			$tickets = Ticket::where('payment_ref', $_GET['payment_ref']);

                $tickets->update(['payment_status' => 1]);

                $email = session('client.products.0.email');
                $filepaths = $this->PDFgen->main($tickets->get());
                $prods = session()->get('client.products');

                $job = ((new TicketMailJob($filepaths, $email, $prods[0]['name']))->delay(now()->addSeconds(1)));
                dispatch($job);

				$student_id = $prods[0]['student_id'];
				$total = 0;

				foreach ($prods as $key => $prod) {
					$total += $prod['price'];
                    $num = $key;
				}

				$student_query = User::where('id', $student_id);
                $student_query->increment('sold_for', $total);
                $student_email = $student_query->first()['email'];

                $name = $prods[0]['name'];
                $email = $prods[0]['email'];
                $phone = $prods[0]['phone'];

                $job = ((new TicketSoldJob($student_email, $num, $total, $name, $email, $phone))->delay(now()->addSeconds(1)));
                dispatch($job);

			return redirect(request()->url())->with('sent-email', session('client.products.0.email'));

		} else {
            session()->forget('client');

			if (session()->has('sent-email')) {
				session()->reflash('sent-email');
				return view('client-ticket.completed.index', ['email' => session('sent-email'), 'name' => 'Bekräftelse']);

			} else {
				return redirect('/');
			}
		}

	}

}
