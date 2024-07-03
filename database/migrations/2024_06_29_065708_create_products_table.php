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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->text('title');
            $table->text('thumnail');
            $table->text('images');
            $table->uuid('uuid');
            $table->string('slug');
            $table->enum('type', ['inside', 'ouside'])->default('inside');
            $table->enum('category', ['tour', 'hotel']);
            $table->double('price');
            $table->double('price_child');
            $table->double('price_baby');
            $table->boolean('is_show')->default(1);
            $table->double('percent_sale')->default(0);
            $table->double('additional_fee')->default(0);
            $table->integer("province_start_id");
            $table->integer("country_id")->default(232);
            $table->integer("province_end_id");
            $table->integer('number_of_day')->default(1);
            $table->enum('tour_pakage', ['luxury', 'standard', 'affordable', 'saving'])->default('standard');
            $table->integer('quantity')->default(1);
            $table->integer('quantity_sold')->default(0);
            $table->date('date_start');
            $table->string('time_start');
            $table->string('status')->default('show');
            $table->integer('tourguide_id');

            $table->enum('transportation', ['airplane', 'car'])->default('airplane');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
