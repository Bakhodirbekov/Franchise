// database/migrations/xxxx_xx_xx_xxxxxx_create_franchises_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('franchises', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->string('slug')->unique();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('short_description', 255);
            $table->text('description');
            $table->decimal('investment_min', 12, 2);
            $table->decimal('investment_max', 12, 2);
            $table->decimal('royalty', 5, 2);
            $table->string('territory')->nullable();
            $table->json('requirements')->nullable();
            $table->enum('status', ['published', 'draft'])->default('draft');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('franchises');
    }
};