<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('product_id');
            
            $table->string('title', 100);

            $table->unsignedInteger('width')->default(0);
            $table->unsignedInteger('height')->default(0);

            $table->float('price')->default(0)->unsignedInteger('price');

            $table->unsignedInteger('inventory_quantity')->default(0);
            
            $table->string('design_url',255)->nullable();

            $table->unsignedTinyInteger('published_state')->default(0)->comment('0=>active, 1=>inactive');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->index('title');
            $table->index('price');
            $table->index('published_state');
            $table->index('created_at');
            $table->index('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
