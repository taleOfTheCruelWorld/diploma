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

        Schema::create('product_property_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->text('description');
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('properties', function (Blueprint $t) {
            $t->id();
            $t->string('name')->unique();
            $t->string('units')->nullable()->default(null);
            $t->string('type');
            $t->foreignId('product_property_group_id')->constrained()->cascadeOnDelete();
            $t->timestamps();
        });

        Schema::create('category_product_properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->boolean('used_in_filter');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('name')->unique();
            $table->string('price');
            $table->text('description');
            $table->bigInteger('count')->default(0);
            $table->boolean('is_active')->default(1);
            $table->string('slug')->unique();
            $table->timestamps();
        });

        Schema::create('product_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->boolean('is_active');
            $table->text('text');
            $table->tinyInteger('mark', false, true);
            $table->timestamps();
        });

        Schema::create('product_comment_media_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_comment_id')->constrained()->cascadeOnDelete();
            $table->string('path');
            $table->timestamps();
        });

        Schema::create('product_media_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('path')->unique();
            $table->timestamps();
        });

        Schema::create('product_properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->foreignId('property_id')->constrained()->cascadeOnDelete();
            $table->string('value')->nullable()->default(null);
            $table->timestamps();
        });

        Schema::create('user_favorite_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('user_cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->bigInteger('count', false, true)->default(1);
            $table->timestamps();
        });

        Schema::create('user_order_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('user_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('fio');
            $table->string('adress');
            $table->string('phone');
            $table->string('total_cost')->default(0);
            $table->foreignId('user_order_status_id')->constrained();
            $table->timestamps();
        });

        Schema::create('user_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $table->string('price');
            $table->integer('count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_order_items');
        Schema::dropIfExists('user_orders');
        Schema::dropIfExists('user_order_statuses');
        Schema::dropIfExists('user_cart_items');
        Schema::dropIfExists('user_favorite_items');
        Schema::dropIfExists('product_properties');
        Schema::dropIfExists('product_media_files');
        Schema::dropIfExists('product_comment_media_files');
        Schema::dropIfExists('product_comments');
        Schema::dropIfExists('products');
        Schema::dropIfExists('category_templates');
        Schema::dropIfExists('category_product_properties');
        Schema::dropIfExists('properties');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('product_property_groups');
    }
};
