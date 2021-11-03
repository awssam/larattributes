<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Eav\Models\AttributableModel;

class CreateAttributeVarcharsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_varchars', function (Blueprint $table) {
            $table->id();
            $table->integer('entity_id');
            $table->foreignIdFor(AttributableModel::class);

            // $table->string('v_1');
            // $table->string('v_2');
            // $table->string('v_3');
            // $table->string('v_4');
            // $table->string('v_5');
            // $table->string('v_6');
            // $table->string('v_7');
            // $table->string('v_8');
            // $table->string('v_9');
            // $table->string('v_10');
            // $table->string('v_11');
            // $table->string('v_12');
            // $table->string('v_13');
            // $table->string('v_14');
            // $table->string('v_15');
            // $table->string('v_16');
            // $table->string('v_17');
            // $table->string('v_18');
            // $table->string('v_19');
            // $table->string('v_20');
            // $table->string('v_21');
            // $table->string('v_22');
            // $table->string('v_23');
            // $table->string('v_24');
            // $table->string('v_25');
            // $table->string('v_26');
            // $table->string('v_27');
            // $table->string('v_28');
            // $table->string('v_29');
            // $table->string('v_30');
            // $table->string('v_31');
            // $table->string('v_32');
            // $table->string('v_33');
            // $table->string('v_34');
            // $table->string('v_35');
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
        Schema::dropIfExists('attribute_varchars');
    }
}
