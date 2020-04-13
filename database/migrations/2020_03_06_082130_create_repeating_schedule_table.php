<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRepeatingScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repeating_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('description');
        });

        Schema::table('schedules', function (Blueprint $table) {
        	$table->unsignedBigInteger('repeating_schedule_id')->after('uid')->nullable();
        	$table->foreign('repeating_schedule_id')->references('id')->on('repeating_schedules')->onDelete('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('schedules', function (Blueprint $table) {
			$table->dropForeign('schedules_repeating_schedule_id_foreign');
			$table->dropColumn('repeating_schedule_id');
		});
        Schema::dropIfExists('repeating_schedules');
    }
}
