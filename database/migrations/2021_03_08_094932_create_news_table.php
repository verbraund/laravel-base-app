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
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->string('description');
            $table->text('text');
            $table->unsignedBigInteger('attachment_id')->nullable();
            $table->unsignedBigInteger('preview_id')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamp('published_to')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('attachment_id')->references('id')->on('files');
            $table->foreign('preview_id')->references('id')->on('images');
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
