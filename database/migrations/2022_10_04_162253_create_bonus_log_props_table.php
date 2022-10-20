<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBonusLogPropsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bonus_log_props', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bonus_log_id');
            $table->string('entity_type');
            $table->unsignedInteger('entity_id');
            $table->timestamps();

            $table->index(['entity_type', 'entity_id']);

            $table->foreign('bonus_log_id')->references('id')->on('bonus_logs')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bonus_log_props');
    }
}
