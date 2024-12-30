<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductTagTable extends Migration {

	public function up()
	{
		Schema::create('product_tag', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('product_id');
			$table->string('tag_id');
		});
	}

	public function down()
	{
		Schema::drop('product_tag');
	}
}