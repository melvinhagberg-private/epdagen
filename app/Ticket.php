<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model {
    protected $fillable = ['ticket_id', 'name', 'email', 'phone'];
    public $timestamps = true;

    public function users() {
        return $this->belongsTo('App\User', 'student_id');
    }

}
