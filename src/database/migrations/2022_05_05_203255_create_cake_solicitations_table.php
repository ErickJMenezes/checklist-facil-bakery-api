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
        Schema::create('cake_solicitations', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->unsignedBigInteger('cake_id');
            $table->timestampsTz();

            $table->foreign('cake_id')
                ->references('id')
                ->on('cakes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cake_solicitations');
    }
};
