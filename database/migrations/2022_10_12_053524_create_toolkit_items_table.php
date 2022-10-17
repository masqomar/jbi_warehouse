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
        Schema::create('toolkit_items', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
			$table->foreignId('toolkit_id')->constrained('toolkits')->cascadeOnUpdate()->cascadeOnDelete();
			$table->foreignId('member_id')->constrained('members')->cascadeOnUpdate()->cascadeOnDelete();
			$table->foreignId('product_id')->constrained('products')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('toolkit_items');
    }
};
