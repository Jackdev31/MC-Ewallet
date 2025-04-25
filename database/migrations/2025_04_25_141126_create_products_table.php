<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_category_id')
                ->constrained('product_categories')
                ->onDelete('cascade');

            $table->string('name',60);
            $table->text('description')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('product_image')->nullable(); 
            $table->integer('quantity')->default(0);
            $table->enum('status', ['available', 'not available'])->default('available');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }

};
