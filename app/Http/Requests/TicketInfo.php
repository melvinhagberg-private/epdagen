<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Ticket;
use App\User;
use Carbon\Carbon;

class TicketInfo extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'Namn' => 'required|string|regex:/^^\s*[a-zA-Z. ]{4,}(?:\s+\w+)+\s*$/',
            'E-post' => 'required|string|email',
            'Telefonnummer' => 'required|regex:/[0-9 +]{9,}/',
            'Biljettantal' => 'required|int'
        ];
    }

    public function consist() {

        $type = request('form-type');

        switch($type) {
            case 'privat':
                $price = 350;
                $type = 1;
                break;
            case 'foretag':
                $price = 500;
                $type = 2;
        }

        $tickets = [];
        $ticket_count = strval(request('Biljettantal'));

        if ($ticket_count != 1) {
            $group = md5(now() . 0);
        } else {
            $group = '';
        }

        $affiliate = User::where('name', request('student_name'))->first()['id'];

        for ($x = 0; $x < $ticket_count; $x++) {
            array_push($tickets, [
                'ticket_id' => md5(now() . ($x + 1)),
                'group' => $group,
                'name' => request('Namn'),
                'email' => request('E-post'),
                'phone' => request('Telefonnummer'),
                'student_id' => $affiliate,
                'type' => $type,
                'price' => $price,
                'created_at' => Carbon::now(),
            ]);
        }

        $client = session('client');
        $client['products'] = $tickets;
        $client['group'] = $group;
        session(['client' => $client]);

        for ($x = 0; $x < count($tickets); $x++) {
            unset($tickets[$x]['price']);
        }

        Ticket::insert($tickets);

        return redirect('/biljett/betala');
    }

}
