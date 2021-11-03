<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Eav\Models\AttributableModel;

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

            // $table->text('v_1');
            // $table->text('v_2');
            // $table->text('v_3');
            // $table->text('v_4');
            // $table->text('v_5');
            // $table->text('v_6');
            // $table->text('v_7');
            // $table->text('v_8');
            // $table->text('v_9');
            // $table->text('v_10');
            // $table->text('v_11');
            // $table->text('v_12');
            // $table->text('v_13');
            // $table->text('v_14');
            // $table->text('v_15');
            // $table->text('v_16');
            // $table->text('v_17');
            // $table->text('v_18');
            // $table->text('v_19');
            // $table->text('v_20');
            // $table->text('v_21');
            // $table->text('v_22');
            // $table->text('v_23');
            // $table->text('v_24');
            // $table->text('v_25');
            // $table->text('v_26');
            // $table->text('v_27');
            // $table->text('v_28');
            // $table->text('v_29');
            // $table->text('v_30');
            // $table->text('v_31');
            // $table->text('v_32');
            // $table->text('v_33');
            // $table->text('v_34');
            // $table->text('v_35');
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
        Schema::dropIfExists('attribute_texts');
    }
}
