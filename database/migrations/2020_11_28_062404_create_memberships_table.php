<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('company_id')->nullable();
            $table->boolean('verified')->default(false);
            $table->boolean('silver')->default(false);
            $table->dateTime('silver_expiry_date')->nullable();
            $table->boolean('gold')->default(false);
            $table->dateTime('gold_expiry_date')->nullable();
            $table->boolean('platinum')->default(false);
            $table->dateTime('platinum_expiry_date')->nullable();
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
        Schema::dropIfExists('memberships');
    }
}
