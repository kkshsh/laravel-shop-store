<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShopBrandTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shop_store', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键');
			$table->string('store_name', 32)->comment('商家名称');
			$table->boolean('store_type')->nullable()->default(1)->comment('商家类型,1:自营,2:第三方');
			$table->timestamps();
			$table->softDeletes()->comment('删除时间');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shop_store');
	}

}
