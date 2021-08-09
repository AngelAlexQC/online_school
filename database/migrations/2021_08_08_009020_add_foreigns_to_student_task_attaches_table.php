<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToStudentTaskAttachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_task_attaches', function (Blueprint $table) {
            $table
                ->foreign('student_task_id')
                ->references('id')
                ->on('student_tasks')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('attach_id')
                ->references('id')
                ->on('comments')
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
        Schema::table('student_task_attaches', function (Blueprint $table) {
            $table->dropForeign(['student_task_id']);
            $table->dropForeign(['attach_id']);
        });
    }
}
