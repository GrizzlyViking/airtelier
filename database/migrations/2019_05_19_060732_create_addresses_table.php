<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('addresses', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->string('name', 20)->nullable(true);
			$table->string('address')->nullable(true);
			$table->string('post_code', 50)->nullable(true);
			$table->string('town', 100)->nullable(true);
			$table->char('country', 2)->default('dk');
			$table->jsonb('geo_location')->nullable(true);
			$table->jsonb('meta')->nullable();
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
		Schema::table('users', function (Blueprint $table) {
			$table->dropForeign('users_address_id_foreign');
		});
		Schema::dropIfExists('addresses');
	}
}
