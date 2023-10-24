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
        Schema::create('transfer_methods_values', function (Blueprint $table) {
            $table->id();
            $table->string('transfer_wallet_name');
            $table->string('transfer_wallet_icon')->nullable();
            $table->string('receive_wallet_name');
            $table->string('receive_wallet_icon')->nullable();
            $table->double('min_value')->default(1.0);
            $table->double('max_value')->default(100.0);
            $table->double('commission')->default(0.0);
            $table->string('admin_wallet_name')->nullable();
            $table->string('admin_wallet_code')->nullable();
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
        Schema::dropIfExists('transfer_methods_values');
    }
};
