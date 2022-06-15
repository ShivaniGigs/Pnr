<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePnrStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pnr_status', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('pnr_number')->index();
            $table->string('train_name');
            $table->string('train_number');
            $table->string('source_station');
            $table->string('boarding_station');
            $table->string('destination_station');
            $table->string('reservation_station');
            $table->string('quota');
            $table->string('ticket_fare');
            $table->string('chart_status');
            $table->string('journey_class');
            $table->string('number_of_passengers');
            $table->date('booking_date');
            $table->date('date_of_journey');
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
        Schema::dropIfExists('pnr_status');
    }
}
