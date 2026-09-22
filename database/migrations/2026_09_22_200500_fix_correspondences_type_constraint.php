<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // For SQLite, re-creating the table with string columns is cleanest and removes the restrictive check constraint
        Schema::dropIfExists('correspondences');

        Schema::create('correspondences', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->string('type')->default('outgoing'); // incoming, outgoing, internal, technical_report, contract_drawing, etc.
            $table->string('subject');
            $table->string('sender');
            $table->string('receiver');
            $table->date('date_issued');
            $table->string('file_path')->nullable();
            $table->string('file_name')->nullable();
            $table->integer('file_size')->nullable();
            $table->string('status')->default('pending_action'); // pending_action, closed, archived, etc.
            $table->string('priority')->default('normal'); // normal, urgent, top_secret
            $table->string('physical_location')->nullable(); // Cabinet, Shelf, Box
            $table->string('tags')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Reversal handled if needed
    }
};
