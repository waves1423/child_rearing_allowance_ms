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
        Schema::create('dependents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calculation_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->tinyInteger('elder')
            ->nullable();
            $table->tinyInteger('special')
            ->nullable();
            $table->tinyInteger('year_old_16to18')
            ->nullable();
            $table->tinyInteger('other_child')
            ->nullable();
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
        Schema::dropIfExists('dependents');
    }
};
