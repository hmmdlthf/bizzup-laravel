<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->enum('gender', ['male', 'female'])->default('male');
            $table->string('company_name')->nullable();
            $table->string('position')->nullable();
            $table->string('profile_pic')->nullable()->default('images/default-profile-pic.webp');
            $table->boolean('is_profile_pic')->default(true);
            $table->string('cover_pic')->nullable()->default('images/default-cover-pic.jpg');
            $table->string('company_logo')->nullable()->default('images/default-company-logo.webp');
            $table->boolean('is_company_logo')->default(true);
            $table->enum('profile_type', ['personal', 'company'])->default('personal');
            $table->string('address')->nullable();
            $table->text('about')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

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
        Schema::dropIfExists('customers');
    }
}
