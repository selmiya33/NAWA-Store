<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration//annyomunas class
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();//id bigint unsigned auto_increment=>primery key
            $table->string('name',100);//VARCHAR n , CHAR 255 ,TEXT (no max)
            $table->timestamps();//created_at , updated_at :TIMESTAMP ,DATETIME
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
