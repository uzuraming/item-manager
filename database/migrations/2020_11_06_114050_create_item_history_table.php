<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_history', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->timestamps();
            $table->unsignedBigInteger('user_id')->nullable(); // 使用したユーザーid
            $table->unsignedBigInteger('item_id')->nullable(); // 使用した物品id
            $table->integer('amount'); // 使用した個数
            
            
            // 外部キー制約
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null'); // usersが削除されたときに、userIdがnull
            $table->foreign('item_id')->references('id')->on('items')->onDelete('set null'); // itemsが削除されたときに、itemIdがnull

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_history');
    }
}
