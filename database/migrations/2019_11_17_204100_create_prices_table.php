<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('amount', 10, 2);
            $table->float('tax_rate', 3, 2)->default(0.25);
            $table->char('currency', 3)->default('DKK');
            $table->char('country', 2)->default('DK');
            $table->json('meta')->nullable(true);
            $table->text('terms')->nullable(true);
        	$table->morphs('priceable');
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
        Schema::dropIfExists('priceable');
        Schema::dropIfExists('prices');
    }
}
