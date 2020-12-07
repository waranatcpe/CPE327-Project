<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitment', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('faculty')->unsigned()->nullable()->default(NULL);
            $table->foreign('faculty')->references('id')->on('faculty');
            $table->integer('department')->unsigned()->nullable()->default(NULL);
            $table->foreign('department')->references('id')->on('departments');
            $table->string('course',50)->nullable();
            $table->string('TCAS_ROUND',10)->nullable();
            $table->string('AR_ROUND',20)->nullable();
            $table->string('openDate',50)->nullable();
            $table->string('closeDate',50)->nullable();

            $table->float('GPA_MTH',5,2)->nullable();
            $table->float('GPA_SCI',5,2)->nullable();
            $table->float('GPA_ENG',5,2)->nullable();
            $table->float('GPAX',5,2)->nullable();

            $table->float('CRE_MTH',5,2)->nullable();
            $table->float('CRE_SCI',5,2)->nullable();
            $table->float('CRE_ENG',5,2)->nullable();

            $table->integer('publish')->nullable();
            $table->integer('ENG_TEST')->nullable();
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
        Schema::dropIfExists('recruitment');
    }
}
