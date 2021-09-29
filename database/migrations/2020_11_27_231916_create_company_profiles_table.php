<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('name')->unique();
            $table->string('slug');
            $table->longText('description')->nullable();
            $table->string('logo')->nullable();
            $table->string('address');
            $table->string('phone')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('business_type')->nullable();
            $table->string('website')->nullable();
            $table->boolean('verified')->default(false);
            $table->boolean('status')->default(false);
            $table->boolean('completed')->default(false);
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
        Schema::dropIfExists('company_profiles');
    }
}
