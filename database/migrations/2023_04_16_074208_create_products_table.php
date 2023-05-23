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
            $table->id();
            $table->string('name_product');
            $table->string('sku')->nullable();
            $table->string('code_product')->unique();
            $table->decimal('import_price', 10, 0)->nullable();
            $table->decimal('export_price', 10, 0)->nullable();
            $table->integer('quantity')->nullable();
            $table->date('expiration_date')->nullable();
            $table->enum('status', ['active', 'inactive']);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->enum('is_active', [1, 2])->default(1);
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('shelves_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->timestamps();

            $table->foreign('unit_id')
                ->references('id')
                ->on('units')
                ->onDelete('cascade');
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');
            $table->foreign('shelves_id')
                ->references('id')
                ->on('shelves');
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
        Schema::dropIfExists('products');
    }
}
