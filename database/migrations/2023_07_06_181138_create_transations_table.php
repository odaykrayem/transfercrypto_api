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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->double('send_amount');
            $table->double('receive_amount');
            $table->double('commission');
            $table->string('from_wallet');
            $table->string('from_wallet_icon');
            $table->string('to_wallet');
            $table->string('to_wallet_icon');
            $table->string('admin_wallet')->nullable();
            $table->string('user_wallet_id')->nullable();
            $table->string('user_op_code')->nullable();
            $table->string('user_image')->nullable();
            $table->string('user_full_name')->nullable();
            $table->string('user_phone')->nullable();
            $table->string('user_place')->nullable();
            $table->string('user_email')->nullable();
            $table->string('admin_op_code')->nullable();
            $table->string('admin_image')->nullable();
            $table->integer('status')->default(0);
            $table->text('message')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('transactions');
    }
};
