<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->boolean('has_formation')->default(false);
            $table->string('desired_arrival_date')->nullable();
            $table->string('desired_arrival_hour')->nullable();
            $table->string('pec_arrival_airport')->nullable();
            $table->string('pec_departure_airport')->nullable();
            $table->string('desired_departure_date')->nullable();
            $table->string('desired_departure_hour')->nullable();
            $table->string('formation_name')->nullable();
            $table->string('formation_state')->nullable();
            $table->string('press_cart')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('participants', function (Blueprint $table) {
            $table->dropColumn([
                'has_formation',
                'desired_arrival_date',
                'desired_arrival_hour',
                'pec_arrival_airport',
                'pec_departure_airport',
                'desired_departure_date',
                'desired_departure_hour',
                'formation_name',
                'formation_state',
                'press_cart',
            ]);
        });
    }
}
