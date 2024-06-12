<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table -> increments('id'); // bigint(20) の ID
            $table -> integer('product_id') -> unsigned();
            $table -> timestamps(); // created_at と updated_at の timestamp

            $table -> foreign('product_id') -> references('id') -> on('products');
            $table -> unique(['product_id'], 'uq_roles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}

