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
            $table->string('code_product')->unique();
            $table->string('name_product');
            $table->decimal('import_price', 10, 2);
            $table->decimal('export_price', 10, 2);
            $table->string('type');
            $table->integer('quantity');
            $table->date('manufacture_date');
            $table->date('expiration_date');
            $table->enum('status', ['active', 'inactive']);
            $table->string('image');
            $table->enum('is_active', [1, 2])->default(1);
            $table->unsignedBigInteger('unit_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('shelves_id');
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
                ->on('shelves')
                ->onDelete('cascade');
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
