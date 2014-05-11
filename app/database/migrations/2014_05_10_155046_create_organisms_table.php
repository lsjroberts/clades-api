<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrganismsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('organisms', function(Blueprint $table) {
			$table->increments('id');

			$table->string('scientific_name');
			$table->string('common_name');
			$table->string('description');
			$table->string('url');

			$table->integer('taxon_id');

			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('organisms');
	}

}
