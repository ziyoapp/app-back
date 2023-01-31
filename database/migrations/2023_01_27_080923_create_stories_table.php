<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stories', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->dateTime('active_start_date')->nullable();
            $table->dateTime('active_end_date')->nullable();
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->integer('sort')->default(1)->index();
            $table->timestamps();

            $table->index('status');
            $table->index(['status', 'active_start_date', 'active_end_date', 'sort']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stories');
    }
}
