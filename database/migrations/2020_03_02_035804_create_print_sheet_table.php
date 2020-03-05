<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintSheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_sheet', function (Blueprint $table) {
            $table->bigIncrements('ps_id');
            $table->unsignedBigInteger('order_id');
            $table->unsignedTinyInteger('type')->default(0)->comment('0=>ecom, 1=>test');
            $table->string('sheet_url',255)->nullable();
            $table->unsignedInteger('width')->default(10);
            $table->unsignedInteger('height')->default(15);
            $table->unsignedTinyInteger('ps_status')->default(0)->comment('0=>active, 1=>inactive');
            
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->index('type');
            $table->index('ps_status');
            $table->index('created_at');
            $table->index('updated_at');

            $table->foreign('order_id')->references('order_id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('print_sheet');
    }
}
