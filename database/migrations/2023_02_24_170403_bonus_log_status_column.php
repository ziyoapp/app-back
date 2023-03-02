<?php

use App\Enums\BonusLogStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BonusLogStatusColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bonus_logs', function (Blueprint $table) {
            $table->string('status', 30)->after('type')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bonus_logs', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
