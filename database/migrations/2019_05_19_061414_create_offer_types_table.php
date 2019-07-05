<?php

use App\Models\OfferType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offer_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type', 20)->unique();
        });

        OfferType::insert([
            ['type' => 'skill'],
            ['type' => 'location'],
            ['type' => 'resource'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_types');
    }
}
