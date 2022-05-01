<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('division_id');
            $table->string('district_id');
            $table->string('upazila_id');
            $table->string('union_id');
            $table->string('title');
            $table->string('title_slug');
            $table->decimal('jomir_poriman');
            $table->decimal('property_selling_price');
            $table->integer('property_discount_type');
            $table->decimal('property_discount');
            $table->decimal('property_discount_price');
            $table->longText('property_description');
            $table->longText('property_conditions');
            $table->longText('related_brif')->nullable();
            $table->string('property_image')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('properties');
    }
};
