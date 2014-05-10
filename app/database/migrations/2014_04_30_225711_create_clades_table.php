<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCladesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('clades', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');

			$table->integer('parent_id')->nullable();
			$table->integer('left')->nullable();
			$table->integer('right')->nullable();
			$table->integer('depth')->nullable();

			$table->timestamps();

			$table->index('parent_id');
			$table->index('left');
			$table->index('right');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('clades');
	}

}
