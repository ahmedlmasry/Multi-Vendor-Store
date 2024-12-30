<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('name');
            $table->string('slug')->unique();
			$table->decimal('price');
			$table->text('image');
			$table->text('description');
			$table->integer('category_id')->unsigned();
			$table->boolean('featured')->default(0);
			$table->decimal('compare_price')->nullable();
            $table->enum('status',['active','draft','archived'])->default('active');
            $table->enum('rating', array('1', '2', '3', '4', '5'));
            $table->json('options')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}
