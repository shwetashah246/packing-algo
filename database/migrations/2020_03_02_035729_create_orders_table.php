<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('order_id');

            $table->string('order_number',255);
            $table->unsignedBigInteger('customer_id');

            //$table->float('total_price')->default(0)->unsignedInteger('total_price');

            $table->string('fulfillment_status',25)->nullable();
            $table->timestamp('fulfilled_date')->nullable();

            $table->unsignedTinyInteger('order_status')->default(0)->comment('0=>pending, 1=>active, 2=>done, 3=>cancelled, 4=>resend');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->index('order_number');
            $table->index('customer_id');
           // $table->index('total_price');
            $table->index('order_status');
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
        Schema::dropIfExists('orders');
    }
}
