<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CardMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cards_members', function (Blueprint $table) {
            $table->id();  
            $table->integer('user_id');  
            $table->integer('card_no');   
            $table->tinyInteger('status')->default('0');     
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
        Schema::dropIfExists('cards_members');
    }
}
