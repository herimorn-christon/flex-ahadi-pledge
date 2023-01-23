<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePledgesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pledges', function (Blueprint $table) {
            $table->id();
            $table->integer('type_id');
            $table->integer('purpose_id');
            $table->integer('user_id');
            $table->string('name');
            $table->mediumText('description');
            $table->string('amount')->nullable();
            $table->date('deadline');
            $table->tinyInteger('status')->default('0');
            $table->integer('created_by');
            $table->timestamps();
            $table->foreign('type_id')->references('id')->on('pledge_type')->onDelete('cascade');
            $table->foreign('purpose_id')->references('id')->on('purposes')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pledges');
    }
}
