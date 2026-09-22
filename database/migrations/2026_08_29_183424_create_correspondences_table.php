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
        Schema::create('correspondences', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->enum('type', ['incoming', 'outgoing', 'internal']);
            $table->string('subject');
            $table->string('sender');
            $table->string('receiver');
            $table->date('date_issued');
            $table->string('file_path')->nullable();
            $table->enum('status', ['pending_action', 'closed', 'archived'])->default('pending_action');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('correspondences');
    }
};
