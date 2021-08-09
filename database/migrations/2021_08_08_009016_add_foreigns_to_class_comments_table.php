<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToClassCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_comments', function (Blueprint $table) {
            $table
                ->foreign('comment_id')
                ->references('id')
                ->on('comments')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('course_class_id')
                ->references('id')
                ->on('course_classes')
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
        Schema::table('class_comments', function (Blueprint $table) {
            $table->dropForeign(['comment_id']);
            $table->dropForeign(['course_class_id']);
        });
    }
}
