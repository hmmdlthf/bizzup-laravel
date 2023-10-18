<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('qrcode_image')->nullable();
            $table->string('url')->nullable();
            $table->string('pay_number')->nullable();
            $table->string('account_holder_name')->nullable();

            $table->unsignedBigInteger('payment_method_type_id')->nullable()->default(1);
            $table->foreign('payment_method_type_id')->references('id')->on('payment_method_types')->onDelete('SET NULL');

            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');

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
        Schema::dropIfExists('payment_methods');
    }
}
