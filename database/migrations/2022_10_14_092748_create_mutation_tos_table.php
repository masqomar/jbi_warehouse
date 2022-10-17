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
        Schema::create('mutation_tos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mutation_id')->constrained('mutations')->cascadeOnUpdate()->cascadeOnDelete();
			$table->foreignId('placement_id')->constrained('placements')->cascadeOnUpdate()->cascadeOnDelete();
			$table->text('description')->nullable();
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
        Schema::dropIfExists('mutation_tos');
    }
};
