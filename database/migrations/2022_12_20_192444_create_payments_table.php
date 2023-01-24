<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id');
            $table->foreignId('pledge_id');
            $table->foreignId('user_id');
            $table->string('amount');
            $table->string('receipt');
            $table->boolean('verified')->default(false);
            $table->integer('created_by');
            $table->timestamps();
            $table->foreign('pledge_id')->references('id')->on('pledges')
            ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade');
            $table->foreign('type_id')->references('id')->on('payment_type')
            ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
