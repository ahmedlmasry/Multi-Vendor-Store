<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->id();
			$table->timestamps();
            $table->string('name');
			$table->string('email')->unique();
			$table->string('phone')->nullable();
			$table->string('password');
			$table->string('image');
			$table->boolean('status');
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
