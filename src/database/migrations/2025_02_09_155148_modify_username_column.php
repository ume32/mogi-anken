<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyUsernameColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        // 一時的に NULL を許可
        $table->string('username')->nullable()->change();
    });

    // NULL のデータを空文字に置き換える
    DB::statement("UPDATE users SET username = '' WHERE username IS NULL");

    Schema::table('users', function (Blueprint $table) {
        // ここで NOT NULL に変更
        $table->string('username')->default('')->change();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable(false)->default('')->change();
        });
    }
}
