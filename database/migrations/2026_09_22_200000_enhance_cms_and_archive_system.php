<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Settings Table
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('group')->default('general');
            $table->timestamps();
        });

        // 2. Inquiries Table
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('service')->nullable();
            $table->string('subject')->nullable();
            $table->text('message');
            $table->string('status')->default('new'); // new, contacted, in_progress, closed
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });

        // 3. Extend Services Table
        Schema::table('services', function (Blueprint $table) {
            $table->json('category')->nullable()->after('title');
            $table->json('short_description')->nullable()->after('description');
            $table->json('features')->nullable()->after('short_description');
            $table->boolean('is_featured')->default(true)->after('icon');
            $table->integer('order')->default(0)->after('is_featured');
        });

        // 4. Extend Projects Table
        Schema::table('projects', function (Blueprint $table) {
            $table->json('category')->nullable()->after('title');
            $table->json('client')->nullable()->after('description');
            $table->json('location')->nullable()->after('client');
            $table->string('area')->nullable()->after('location');
            $table->string('status')->default('completed')->after('area'); // completed, ongoing, planning
            $table->boolean('is_featured')->default(true)->after('status');
            $table->integer('order')->default(0)->after('is_featured');
        });

        // 5. Extend Correspondences Table
        Schema::table('correspondences', function (Blueprint $table) {
            $table->string('priority')->default('normal')->after('status'); // normal, urgent, top_secret
            $table->string('physical_location')->nullable()->after('priority'); // Cabinet, Shelf, Box
            $table->string('tags')->nullable()->after('physical_location');
            $table->string('file_name')->nullable()->after('file_path');
            $table->integer('file_size')->nullable()->after('file_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inquiries');
        Schema::dropIfExists('settings');

        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['category', 'short_description', 'features', 'is_featured', 'order']);
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['category', 'client', 'location', 'area', 'status', 'is_featured', 'order']);
        });

        Schema::table('correspondences', function (Blueprint $table) {
            $table->dropColumn(['priority', 'physical_location', 'tags', 'file_name', 'file_size']);
        });
    }
};
