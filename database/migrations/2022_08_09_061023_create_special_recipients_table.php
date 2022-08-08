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
        Schema::create('special_recipients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recipient_id')
            ->constrained()
            ->onUpdate('cascade')
            ->onDelete('cascade');
            $table->integer('allowance_type');
            $table->boolean('is_submitted')->nullable();
            $table->string('additional_document')->nullable();
            $table->boolean('is_public_pentioner');
            $table->text('note')->nullable();
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
        Schema::dropIfExists('special_recipients');
    }
};
