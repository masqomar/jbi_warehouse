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
        Schema::create('mutation_froms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mutation_id')->constrained('mutations')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('placement_id')->constrained('placements')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('asset_item_id');
            // $table->foreignId('asset_item_id')->constrained('asset_items')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('mutation_froms');
    }
};
