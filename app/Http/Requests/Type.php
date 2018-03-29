<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Type extends FormRequest
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
    public function rules()
    {
        return [
            'form-type' => 'required'
        ];
    }

    public function consist() {
        $r = request('form-type');
        if ($r != 'privat' && $r != 'foretag') {
            return back();
        }

        if (session()->has('client')) {
            session()->flush();
        }

        session(['client' => array(
            'type' => request('form-type')
        )]);

        return redirect('/biljett/uppgifter');
    }
}
