<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Larattributes\Models\AttributableModel;

class CreateAttributeDatetimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_datetimes', function (Blueprint $table) {
            $table->id();
            $table->integer('entity_id');
            $table->foreignIdFor(AttributableModel::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_datetimes');
    }
}
