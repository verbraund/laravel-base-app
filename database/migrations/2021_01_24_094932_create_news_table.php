<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('user_id')->default(0);
            $table->foreign('user_id')->references('id')->on('admins');
            $table->string('title');
            $table->string('slug');
            $table->string('description');
            $table->text('text');
            $table->dateTime('published_at')->default(null);
            $table->timestamps();
        });

        DB::statement('ALTER TABLE `news` ADD FULLTEXT INDEX news (title,slug,description,text)');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news', function($table) {
            $table->dropIndex('news');
        });
        Schema::dropIfExists('news');
    }
}
