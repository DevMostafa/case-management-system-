<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('case_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('case_id')->unsigned()->nullable();
            $table->string('file_name');
            $table->string('file_path');
            $table->string('description');
            $table->timestamps();
        });
    }
//php artisan migrate --path=/database/migrations/selected/
//https://laracasts.com/discuss/channels/laravel/ho-to-execute-a-specific-migration?page=1
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('case_files');
    }
}
