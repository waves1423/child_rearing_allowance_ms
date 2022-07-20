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
        Schema::create('calculations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipient_id')
            ->nullable()
            ->constrained('recipients')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('spouse_id')
            ->nullable()
            ->constrained('spouses')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->foreignId('obligor_id')
            ->nullable()
            ->constrained('obligors')
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->unsignedInteger('deducted_income')
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
        Schema::dropIfExists('calculations');
    }
};
