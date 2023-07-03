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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user_id")->unique()->constrained("users","id")->cascadeOnDelete();
            $table->string("first_name",64);
            $table->string("last_name",64);
            $table->enum("gender",['male','femle']);
            $table->date("birthday")->nullable();
            $table->string("city",128)->nullable();
            $table->string("street",128)->nullable();
            $table->string("province",128)->nullable();
            $table->string("postal_code",128)->nullable();
            $table->char("country_code",2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
