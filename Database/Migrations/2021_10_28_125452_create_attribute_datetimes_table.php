<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Eav\Models\AttributableModel;

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

            // $table->dateTime('v_1');
            // $table->dateTime('v_2');
            // $table->dateTime('v_3');
            // $table->dateTime('v_4');
            // $table->dateTime('v_5');
            // $table->dateTime('v_6');
            // $table->dateTime('v_7');
            // $table->dateTime('v_8');
            // $table->dateTime('v_9');
            // $table->dateTime('v_10');
            // $table->dateTime('v_11');
            // $table->dateTime('v_12');
            // $table->dateTime('v_13');
            // $table->dateTime('v_14');
            // $table->dateTime('v_15');
            // $table->dateTime('v_16');
            // $table->dateTime('v_17');
            // $table->dateTime('v_18');
            // $table->dateTime('v_19');
            // $table->dateTime('v_20');
            // $table->dateTime('v_21');
            // $table->dateTime('v_22');
            // $table->dateTime('v_23');
            // $table->dateTime('v_24');
            // $table->dateTime('v_25');
            // $table->dateTime('v_26');
            // $table->dateTime('v_27');
            // $table->dateTime('v_28');
            // $table->dateTime('v_29');
            // $table->dateTime('v_30');
            // $table->dateTime('v_31');
            // $table->dateTime('v_32');
            // $table->dateTime('v_33');
            // $table->dateTime('v_34');
            // $table->dateTime('v_35');
            // $table->timestamps();
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
