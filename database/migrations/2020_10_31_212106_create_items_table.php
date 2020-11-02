<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item_name'); // item_name カラム追加
            $table->unsignedBigInteger('room_id'); // 部屋のid
            $table->unsignedBigInteger('place_id'); // 場所のid
            $table->unsignedBigInteger('place_detail_id'); // 場所詳細のid
            $table->unsignedBigInteger('user_id')->nullable(); // ユーザーID。NuLL許容
            $table->integer('alert_amount');// 警告する残量
            $table->integer('remaining_amount');// 残量
            $table->integer('status'); // ステータス。0が未承認、1が承認、2が拒否、3は発注済み
            $table->timestamps();
            
            // 外部キー制約 部屋のIdと場所を紐づけ
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            // 外部キー制約 場所のIdと場所を紐づけ
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
            // 外部キー制約 場所詳細のIdと場所を紐づけ
            $table->foreign('place_detail_id')->references('id')->on('place_details')->onDelete('cascade');
            
            // 外部キー制約 場所詳細のIdと場所を紐づけ
            // ユーザーが消えたときはNuLLにする
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
