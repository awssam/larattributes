<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Modules\Eav\Models\AttributableModel;

class CreateAttributeDecimalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_decimals', function (Blueprint $table) {
            $table->id();
            $table->integer('entity_id');
            $table->foreignIdFor(AttributableModel::class);

            // $table->decimal('v_1',10,4);
            // $table->decimal('v_2',10,4);
            // $table->decimal('v_3',10,4);
            // $table->decimal('v_4',10,4);
            // $table->decimal('v_5',10,4);
            // $table->decimal('v_6',10,4);
            // $table->decimal('v_7',10,4);
            // $table->decimal('v_8',10,4);
            // $table->decimal('v_9',10,4);
            // $table->decimal('v_10',10,4);
            // $table->decimal('v_11',10,4);
            // $table->decimal('v_12',10,4);
            // $table->decimal('v_13',10,4);
            // $table->decimal('v_14',10,4);
            // $table->decimal('v_15',10,4);
            // $table->decimal('v_16',10,4);
            // $table->decimal('v_17',10,4);
            // $table->decimal('v_18',10,4);
            // $table->decimal('v_19',10,4);
            // $table->decimal('v_20',10,4);
            // $table->decimal('v_21',10,4);
            // $table->decimal('v_22',10,4);
            // $table->decimal('v_23',10,4);
            // $table->decimal('v_24',10,4);
            // $table->decimal('v_25',10,4);
            // $table->decimal('v_26',10,4);
            // $table->decimal('v_27',10,4);
            // $table->decimal('v_28',10,4);
            // $table->decimal('v_29',10,4);
            // $table->decimal('v_30',10,4);
            // $table->decimal('v_31',10,4);
            // $table->decimal('v_32',10,4);
            // $table->decimal('v_33',10,4);
            // $table->decimal('v_34',10,4);
            // $table->decimal('v_35',10,4);

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
        Schema::dropIfExists('attribute_decimals');
    }
}
