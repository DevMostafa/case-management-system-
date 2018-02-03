<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAltercaseidtovictimidTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up() {
        
        Schema::table('case_files', function(Blueprint $table)
        {
            $table->dropColumn('case_id');
        });
        Schema::table('case_files', function(Blueprint $table)
        {
            $table->integer('victim_id');
        });       
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        
        Schema::table('case_files', function(Blueprint $table)
        {
            $table->dropColumn('case_id');
        });
        Schema::table('case_files', function(Blueprint $table)
        {
            $table->integer('victim_id');


        });
    }

}
