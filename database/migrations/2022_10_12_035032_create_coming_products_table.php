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
        Schema::create('coming_products', function (Blueprint $table) {
            $table->id();
            $table->string('code');
			$table->date('date');
			$table->foreignId('product_id')->constrained('products')->cascadeOnUpdate()->cascadeOnDelete();
			$table->integer('price');
			$table->integer('qty');
			$table->foreignId('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
			$table->foreignId('company_id')->constrained('companies')->cascadeOnUpdate()->cascadeOnDelete();
			$table->foreignId('supplier_id')->nullable()->constrained('suppliers')->cascadeOnUpdate()->cascadeOnDelete();
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
        Schema::dropIfExists('coming_products');
    }
};
