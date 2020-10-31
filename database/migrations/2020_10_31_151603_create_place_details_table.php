<?php

// 場所詳細テーブルを作るためのファイル

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('place_detail_name'); // place_detail_name カラム追加
            $table->unsignedBigInteger('room_id'); // 部屋のid
            $table->unsignedBigInteger('place_id'); // 場所のid
            $table->timestamps();
            
            // 外部キー制約 部屋のIdと場所を紐づけ
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            // 外部キー制約 場所のIdと場所を紐づけ
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('place_details');
    }
}
