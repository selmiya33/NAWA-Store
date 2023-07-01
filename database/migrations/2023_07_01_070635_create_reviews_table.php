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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_id")->constrained('products','id')->cascadeOnDelete();
            $table->foreignId("user_id")->constrained('users','id')->cascadeOnDelete();
            $table->enum('rating',range(1 ,5 ));
            $table->string('subject',255);
            $table->text('message');
            $table->enum('status',["visable","hidden"])->default("hidden");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
