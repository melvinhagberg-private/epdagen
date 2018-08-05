<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Dompdf\Dompdf;
use App\User;

class Receipt extends Model {

	public function __construct($tickets) {
		$this->date = $tickets[0]['created_at']->toDateString();

		$student_row = User::where('id', $tickets[0]['student_id'])->first();
		$this->student = $student_row['grade'] . ' ' . explode(' ', $student_row['name'])[0];

		$this->order = [
		    'id' => $tickets[0]['type'],
		    'name' => ($tickets[0]['type'] === 1) ? 'Biljett privat' : 'Biljett företag', // get epdagen date from database
		    'num' => sizeof($tickets),
		    'price' => number_format(($tickets[0]['type'] === 1) ? 350 : 500, 2, ',', ','),
		    'totals' => number_format(sizeof($tickets) * (($tickets[0]['type'] === 1) ? 350 : 500), 2, ',', ',')
		];

		$this->customer_ref = $tickets[0]['group'];
		// pay method
		// cost info (including tax)
	}
    
	public function generate() {
		$pdf = new Dompdf;

		$html = view('pdfs.receipt')->with([
			'date' => $this->date,
			'order' => $this->order,
			'customer_ref' => $this->customer_ref,
			'student' => $this->student
		]);

		$pdf->loadHtml($html);
		$pdf->render();
		$content = $pdf->output();

		$path = storage_path() . '/pdfs/kvittens_' . $this->customer_ref . '.pdf';
		file_put_contents($path, $content);
		return $path;
	}

}
