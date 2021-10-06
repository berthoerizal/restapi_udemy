<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    // ['class_id', 'section_id', 'name', 'phone', 'email', 'password', 'photo', 'address', 'gender'];
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id');
            $table->integer('section_id');
            $table->string('name', 50);
            $table->string('phone');
            $table->string('email', 50);
            $table->string('password');
            $table->string('photo')->nullable();
            $table->string('address');
            $table->string('gender');
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
        Schema::dropIfExists('students');
    }
}
