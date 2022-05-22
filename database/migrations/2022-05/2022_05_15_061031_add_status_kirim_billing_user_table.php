<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusKirimBillingUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('users', 'status_kirim_billing') == false) {
            Schema::table('users', function (Blueprint $table) {
                $table->tinyInteger('status_kirim_billing_gold')->default(0)->nullable();
                $table->tinyInteger('status_kirim_billing_silver')->default(0)->nullable();
                $table->tinyInteger('status_kirim_billing_bronze')->default(0)->nullable();
                $table->tinyInteger('status_kirim_billing_early')->default(0)->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status_kirim_billing_gold');
            $table->dropColumn('status_kirim_billing_silver');
            $table->dropColumn('status_kirim_billing_bronze');
            $table->dropColumn('status_kirim_billing_early');
        });
    }
}
