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
        Schema::create('products_buys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('buy_id', 'buy_id_fk')
                  ->references('id')
                  ->on('buys')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreignId('product_id', 'product_id_fk')
                  ->references('id')
                  ->on('products')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->integer('quantity');
            $table->float('total');
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
        Schema::dropIfExists('products_buys');
    }
};
