<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoresTable extends Migration {

	public function up()
	{
		Schema::create('stores', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
			$table->string('name');
			$table->text('logo_image')->nullable();
			$table->text('cover_image')->nullable();
			$table->text('description')->nullable();
			$table->boolean('status')->default(1);
			$table->string('slug')->unique();
		});
	}

	public function down()
	{
		Schema::drop('stores');
	}
}
