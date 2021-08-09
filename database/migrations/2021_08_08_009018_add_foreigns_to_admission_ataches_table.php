<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToAdmissionAtachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admission_ataches', function (Blueprint $table) {
            $table
                ->foreign('admission_id')
                ->references('id')
                ->on('admissions')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admission_ataches', function (Blueprint $table) {
            $table->dropForeign(['admission_id']);
        });
    }
}
