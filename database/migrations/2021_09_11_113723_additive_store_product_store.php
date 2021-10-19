<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AdditiveStoreProductStore extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additive_store_product_store', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('product_store_id');
            $table->foreignId('additive_store_id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('additive_store_product_store');
    }
}
