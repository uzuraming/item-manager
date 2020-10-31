<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('places', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('place_name'); // place_name カラム追加
            $table->unsignedBigInteger('room_id'); // 部屋のid
            $table->timestamps();
            
            // 外部キー制約 部屋のIdと場所を紐づけ
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
}
