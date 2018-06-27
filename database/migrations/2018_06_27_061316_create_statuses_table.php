<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->text('content');
            $table->integer('user_id')->index();
            //後面會借助user_id來查找指定用戶發布過的所有動態，為了提高查詢效率，在這裡需要為該字段加上索引。
            $table->index(['created_at']);
            //為created_at加上索引是因為要根據動態創建時間進行到續輸出，並在頁面上顯示，使新建的排在靠前的位置。
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
        Schema::dropIfExists('statuses');
    }
}
