<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('product_id')->unique();
            $table->string('slot_id');
            $table->string('name');
            $table->string('slug');
            $table->string('price');
            $table->string('image')->nullable();
            $table->string('category_id');
            $table->string('subcategory_id');
            $table->string('brand');
            $table->string('country_id');
            $table->string('state_id');
            $table->longText('description');
            $table->string('type');
            $table->string('part_no')->nullable();
            $table->string('section');
            $table->boolean('status')->default(false);
            $table->boolean('approved')->default(false);
            $table->boolean('rejected')->default(false);  
            $table->boolean('expired')->default(false);
            $table->dateTime('expiry_date')->nullable();
            $table->boolean('availability')->default(true);
            $table->boolean('deleted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
