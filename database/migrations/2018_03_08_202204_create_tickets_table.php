<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ticket_id');
            $table->string('group')->default('');

            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->integer('type');
            $table->string('company')->nullable();

            $table->boolean('used')->default(false);
            $table->integer('student_id')->nullable();
            $table->integer('payment_status')->default(0);
            $table->string('payment_ref')->default('');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
