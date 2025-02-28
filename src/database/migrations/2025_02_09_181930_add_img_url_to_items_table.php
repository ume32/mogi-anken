<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImgUrlToItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('items', function (Blueprint $table) {
        $table->string('img_url')->after('description')->nullable()->comment('商品の画像URL');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
    Schema::table('items', function (Blueprint $table) {
        $table->dropColumn('img_url');
    });
}
}
