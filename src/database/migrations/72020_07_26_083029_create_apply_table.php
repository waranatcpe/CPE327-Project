<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apply', function (Blueprint $table) {
            $table->increments('id');

            $table->integer("profile_id")->unsigned()->nullable()->default(NULL);
            $table->foreign('profile_id')->references('id')->on('user_profiles');
            $table->integer("recruitment_id")->unsigned()->nullable()->default(NULL);
            $table->foreign("recruitment_id")->references('id')->on("recruitment");
            $table->integer("result")->nullable();
            $table->string("portfolio",100)->nullable();
            $table->string("link")->nullable();
            $table->integer("status")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apply');
    }
}
