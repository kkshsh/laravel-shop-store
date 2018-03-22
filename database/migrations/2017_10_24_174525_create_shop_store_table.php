<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateShopStoreTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shop_store', function(Blueprint $table)
		{
			$table->integer('id', true)->comment('主键ID');
			$table->string('store_name', 80)->default('')->unique('u_store_name')->comment('店铺名称');
			$table->boolean('store_type')->default(1)->comment('商家类型,1:自营,2:第三方');
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
