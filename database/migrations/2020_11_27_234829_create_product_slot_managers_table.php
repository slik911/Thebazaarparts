<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSlotManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_slot_managers', function (Blueprint $table) {
            $table->id();
            $table->string('slot_id')->nullable();
            $table->string('user_id');
            $table->string('package');
            $table->integer('total_slot_assigned');
            $table->integer('total_slot_remaining');
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->boolean('completed')->default(false);
            $table->boolean('expired')->default(false);
            $table->boolean('expiry_notification')->default(false);
            $table->string('membership_reference')->nullable();
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
        Schema::dropIfExists('product_slot_managers');
    }
}
