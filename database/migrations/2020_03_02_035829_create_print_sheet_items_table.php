<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrintSheetItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('print_sheet_items', function (Blueprint $table) {
            $table->bigIncrements('psi_id');
            $table->unsignedBigInteger('ps_id');
            $table->unsignedBigInteger('order_item_id');

            $table->string('image_url',255)->nullable();

            $table->integer('x_pos')->default(0);
            $table->integer('y_pos')->default(0);

            $table->integer('width')->default(0);
            $table->integer('height')->default(0);

            $table->unsignedTinyInteger('psi_status')->default(0)->comment('0=>pass, 1=>reject, 2=>complete');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));

            $table->index('ps_id');
            $table->index('order_item_id');
            $table->index('psi_status');
            $table->index('created_at');
            $table->index('updated_at');


            $table->foreign('ps_id')->references('ps_id')->on('print_sheet');
            $table->foreign('order_item_id')->references('order_item_id')->on('order_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('print_sheet_items');
    }
}
