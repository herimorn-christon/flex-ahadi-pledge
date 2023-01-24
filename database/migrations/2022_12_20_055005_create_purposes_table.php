<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurposesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purposes', function (Blueprint $table) {
            $table->id();           
            $table->string('title');
            $table->string('description');
            $table->date('start_date');                      
            $table->date('end_date');
            $table->tinyInteger('status')->default('0');            
            $table->integer('created_by');
            $table->timestamps();
            
        });
    }

    /**cle
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purposes');
    }
}
