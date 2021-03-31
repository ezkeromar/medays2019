<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('civility');
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthday')->nullable();
            $table->dateTime('inscriptionDate')->useCurrent()->nullable();
            $table->string('function')->nullable();
            $table->string('organization')->nullable();
            $table->string('nationality')->nullable();
            $table->string('cin')->nullable();
            $table->string('passport')->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('email');
            $table->string('identity_type');
            $table->string('num_identity');
            $table->string('pro_phone')->nullable();
            $table->string('mobile_phone')->nullable();
            $table->string('webcode')->nullable();
            $table->string('access_code')->nullable();
            $table->longText('motivation')->nullable();
            $table->unsignedBigInteger('status')->default(0);
            $table->unsignedBigInteger('type_id')->nullable();
            $table->string('language', 2)->default('fr');

            $table->boolean('has_restoration')->default(false);
            $table->boolean('has_hebergement')->default(false);
            $table->boolean('has_transfert')->default(false);
            $table->boolean('has_pec')->default(false);

            $table->string('air_ticket')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('restoration')->nullable();
            $table->string('hotel_id')->nullable();
            $table->unsignedBigInteger('room_category_id')->nullable();
            $table->tinyInteger('room_type')->nullable();
            $table->string('arrival_date')->nullable();
            $table->string('departure_date')->nullable();
            $table->integer('nights_count')->nullable();
            $table->integer('level')->nullable();

            $table->string('transfer_arrival_date')->nullable();
            $table->time('transfer_arrival_time')->nullable();
            $table->string('arrival_airport')->nullable();
            $table->string('arrival_airline_company')->nullable();
            $table->string('arrival_flight_number')->nullable();
            $table->string('arrival_recovery_point')->nullable();
            $table->string('arrival_deposit_point')->nullable();
            $table->string('transfer_departure_date')->nullable();
            $table->time('transfer_departure_time')->nullable();
            $table->string('departure_airport')->nullable();
            $table->string('departure_airline_company')->nullable();
            $table->string('departure_flight_number')->nullable();
            $table->string('departure_recovery_point')->nullable();
            $table->string('departure_deposit_point')->nullable();

            // $table->foreign('status')->references('id')->on('status');
            // $table->foreign('type')->references('id')->on('types');
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
        Schema::dropIfExists('participants');
    }
}
