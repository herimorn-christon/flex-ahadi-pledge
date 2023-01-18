<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('mname');
            $table->string('lname');
            $table->integer('jumuiya')->nullable();
            $table->string('phone')->unique();
            $table->string('profile_picture')->nullable();
            $table->string('email')->unique()->nullable();
            $table->date('date_of_birth');
            $table->string('gender');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('fcm_token')->nullable();
            $table->rememberToken();
            $table->timestamps();        
            $table->tinyInteger('status')->default('0');

            //new additions

            $table->string('place_of_birth')->nullable();
            $table->integer('martial_status')->nullable()->comment('1-Married | 2-Single | 3-Widow | 4-Divorced');
            $table->integer('marriage_type')->nullable()->comment('1-Christian | 2-Other');
            $table->date('marriage_date')->nullable();
            $table->string('partner_name')->nullable();
            $table->string('place_of_marriage')->nullable();
            $table->string('old_usharika')->nullable();
            $table->string('fellowship_name')->nullable();
            $table->string('neighbour_msharika_name')->nullable();
            $table->string('neighbour_msharika_phone')->nullable();
            $table->string('deacon_name')->nullable(); //mzee wa kanisa
            $table->string('deacon_phone')->nullable();
            $table->integer('occupation')->nullable()->comment('1-Employed | 2-Unemployed | 3-Student');
            $table->string('place_of_work')->nullable();
            $table->string('proffession')->nullable();
            $table->boolean('can_volunteer')->default(false);
            $table->boolean('baptized')->default(false);
            $table->date('baptization_date')->nullable();
            $table->boolean('kipaimara')->default(false);
            $table->date('kipaimara_date')->nullable();
            $table->boolean('sacramenti_meza_bwana')->default(false);

            


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
