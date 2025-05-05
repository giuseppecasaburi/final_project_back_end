<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();

            $table->string("title");
            $table->text("story");
            $table->date("year_of_publication");
            $table->smallInteger("duration");
            $table->bigInteger("director_id")->unsigned()->nullable();
            $table->timestamps();

            $table->foreign("director_id")
                ->references("id")
                ->on("directors");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
