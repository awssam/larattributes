<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Larattributes\Models\AttributableModel;

class CreateAttributeTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_texts', function (Blueprint $table) {
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
        Schema::dropIfExists('attribute_texts');
    }
}
