<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable()->default(NULL);
            $table->foreign('user_id')->unique()->references('id')->on('users');
            $table->string('citizen_id')->unique()->nullable();
            $table->string('prefix',10)->nullable();
            $table->string('firstname',50)->nullable();
            $table->string('lastname',50)->nullable();
            $table->string('telephone',20)->nullable();
            $table->string('email',50)->nullable();
            $table->string('facebook',50)->nullable();
            $table->string('lineID',50)->nullable();

            $table->string('school',100)->nullable();

            $table->float('GPA_MTH',5,2)->nullable();
            $table->float('GPA_SCI',5,2)->nullable();
            $table->float('GPA_ENG',5,2)->nullable();
            $table->float('GPAX',5,2)->nullable();

            $table->float('CRE_MTH',5,2)->nullable();
            $table->float('CRE_SCI',5,2)->nullable();
            $table->float('CRE_ENG',5,2)->nullable();

            $table->float('IELTS',5,2)->nullable();
            $table->float('TOEFL',5,2)->nullable();
            $table->float('TOEIC',5,2)->nullable();
            $table->float('CUTEP',5,2)->nullable();

            $table->string('transcript')->nullable();
            $table->string('link')->nullable();

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
        Schema::dropIfExists('user_profiles');
    }
}
