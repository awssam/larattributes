<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Eav\Models\AttributableModel;

class CreateAttributeIntegersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_integers', function (Blueprint $table) {
            $table->id();
            $table->integer('entity_id');
            $table->foreignIdFor(AttributableModel::class);

            // $table->integer('v_1');
            // $table->integer('v_2');
            // $table->integer('v_3');
            // $table->integer('v_4');
            // $table->integer('v_5');
            // $table->integer('v_6');
            // $table->integer('v_7');
            // $table->integer('v_8');
            // $table->integer('v_9');
            // $table->integer('v_10');
            // $table->integer('v_11');
            // $table->integer('v_12');
            // $table->integer('v_13');
            // $table->integer('v_14');
            // $table->integer('v_15');
            // $table->integer('v_16');
            // $table->integer('v_17');
            // $table->integer('v_18');
            // $table->integer('v_19');
            // $table->integer('v_20');
            // $table->integer('v_21');
            // $table->integer('v_22');
            // $table->integer('v_23');
            // $table->integer('v_24');
            // $table->integer('v_25');
            // $table->integer('v_26');
            // $table->integer('v_27');
            // $table->integer('v_28');
            // $table->integer('v_29');
            // $table->integer('v_30');
            // $table->integer('v_31');
            // $table->integer('v_32');
            // $table->integer('v_33');
            // $table->integer('v_34');
            // $table->integer('v_35');

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
        Schema::dropIfExists('attribute_integers');
    }
}
