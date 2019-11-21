<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('images', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('owner_id');
			$table->foreign('owner_id')
				->references('id')
				->on('users')
				->onDelete('cascade');
			$table->string('file');
			$table->timestamps();
		});

		Schema::create('gallery', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->unsignedBigInteger('image_id');
			$table->string('purpose', 40)->nullable(true);
			$table->foreign('image_id')
				->references('id')
				->on('images')
				->onDelete('cascade');
			$table->morphs('relation');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('gallery');
		Schema::dropIfExists('images');
	}
}
