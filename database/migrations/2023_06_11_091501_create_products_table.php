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
        Schema::create('products', function (Blueprint $table) {
            $table->id();//primery key not accept null
            $table->string('name_product',80);
            $table->string('slug')->unique();//accept null
            // $table->unsignedBigInteger('category_id')->nullable();
            $table->foreignId('category_id')->nullable()
                    ->constrained('categories','id')->nullOnDelete();//->cascadeOnDelete()->restrictOnDelete;
            $table->text('description')->nullable();
            $table->unsignedInteger('quantity')->default(1);
            $table->text('short_description')->nullable();
            $table->unsignedFloat('price')->default(0);
            $table->unsignedFloat('comper_price')->nullable();
            $table->string('image')->nullable();// or binary('image') 
            $table->enum('status',['draft','active','archived'])->default('active');//case insensitive
            $table->timestamps();

            // $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
