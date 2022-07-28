<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deductions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calculation_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->tinyInteger('disabled');
            $table->tinyInteger('specially_disabled');
            $table->tinyInteger('singleparent_or_workingstudent');
            $table->unsignedInteger('special_spouse');
            $table->unsignedInteger('medical_expense');
            $table->unsignedInteger('small_enterprise');
            $table->unsignedInteger('other');
            $table->unsignedInteger('common');
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
        Schema::dropIfExists('deductions');
    }
};
