<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_descriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->text('description');
            $table->timestamps();
        });
    }
//php artisan migrate --path=/database/migrations/selected/

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('case_descriptions');
    }
}
