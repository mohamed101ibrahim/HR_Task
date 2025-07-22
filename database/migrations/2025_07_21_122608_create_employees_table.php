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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email')->unique();
            $table->integer('phone')->nullable();
            $table->string('position');
            $table->decimal('salary', 10, 2);
            $table->date('hired_at');
            $table->enum('status', ['active', 'inactive']);
            $table->softDeletes();
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade');
            $table->timestamps();
            $table->index('name');
            $table->index('hired_at');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropIndex(['name']);
            $table->dropIndex(['status']);
            $table->dropIndex(['hired_at']);
        });

        Schema::dropIfExists('employees');
    }
};