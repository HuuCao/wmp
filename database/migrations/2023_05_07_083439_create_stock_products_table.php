<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->decimal('import_price', 10, 0)->nullable();
            $table->decimal('export_price', 10, 0)->nullable();
            $table->decimal('total', 10, 0)->nullable();
            $table->string('type'); // loại hàng nhập hay xuất
            $table->integer('quantity')->default(0);
            $table->date('expiration_date')->nullable();
            $table->enum('is_active', [1, 2])->default(1);
            $table->timestamps();

            $table->foreign('stock_id')->references('id')->on('stock_inward')->onDelete('cascade');
            $table->foreign('stock_id')->references('id')->on('stock_outward')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');

            $table->foreign('unit_id')
                ->references('id')
                ->on('units')
                ->onDelete('cascade');
            $table->foreign('supplier_id')
                ->references('id')
                ->on('suppliers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_products');
    }
}
