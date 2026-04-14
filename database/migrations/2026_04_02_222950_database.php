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

        Schema::create('product_property_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('category_id')->nullable()->constrained()->cascadeOnDelete();
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('category_product_properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('product_property_type_id')->constrained();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained();
            $table->string('name');
            $table->string('price');
            $table->string('description');
            $table->bigInteger('count')->default(0);
            $table->timestamps();
        });

        Schema::create('product_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->boolean('is_active');
            $table->string('text');
            $table->tinyInteger('mark', false, true);
            $table->timestamps();
        });

        Schema::create('product_comment_media_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_comment_id')->constrained();
            $table->string('path');
            $table->timestamps();
        });

        Schema::create('product_media_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->string('path');
            $table->timestamps();
        });

        Schema::create('product_properties', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained();
            $table->foreignId('category_product_property_id')->constrained();
            $table->string('value');
            $table->timestamps();
        });

        Schema::create('user_favorite_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->timestamps();
        });

        Schema::create('user_cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->integer('count');
            $table->timestamps();
        });

        Schema::create('user_order_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('user_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('fio');
            $table->string('adress');
            $table->string('phone');
            $table->string('total_cost')->default(0);
            $table->foreignId('user_order_status_id')->constrained();
            $table->timestamps();
        });

        Schema::create('user_order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_order_id')->constrained();
            $table->foreignId('product_id')->constrained();
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
        Schema::dropIfExists('categories');
        Schema::dropIfExists('product_property_types');
    }
};
