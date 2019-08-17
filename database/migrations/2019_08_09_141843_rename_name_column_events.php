<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameNameColumnEvents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->renameColumn('name', 'title');
            $table->string('sub_title')->nullable();
            $table->text('description')->nullable();
            $table->json('frequency')->nullable();
            $table->json('meta')->nullable();
            $table->dropColumn('start');
            $table->dropColumn('end');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->renameColumn('title', 'name');
            $table->dropColumn('sub_title');
            $table->dropColumn('description');
            $table->dropColumn('frequency');
            $table->dropColumn('meta');
            $table->timestamp('start')->nullable(true);
            $table->timestamp('end')->nullable(true);
        });
    }
}
