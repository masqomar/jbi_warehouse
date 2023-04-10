<?php

use App\Models\Category;
use App\Models\Company;
use App\Models\Unit;
use App\Models\User;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('full_code');
            $table->integer('quantity');
            $table->integer('price');
            $table->integer('danger_level');
            $table->string('product_image')->nullable();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnUpdate();
            $table->foreignIdFor(Unit::class)->constrained()->cascadeOnUpdate();
            $table->foreignIdFor(Company::class)->constrained()->cascadeOnUpdate();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnUpdate();

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
        Schema::dropIfExists('products');
    }
};
