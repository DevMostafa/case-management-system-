<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlterCaseFileDescriptionToDescriptionId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('case_files', function(Blueprint $table)
        {
            $table->dropColumn('description');
        });
         Schema::table('case_files', function(Blueprint $table)
        {
            $table->integer('description_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::table('case_files', function(Blueprint $table)
        {
            $table->dropColumn('description');
        });
         Schema::table('case_files', function(Blueprint $table)
        {
            $table->integer('description_id');
        });
    }
}
