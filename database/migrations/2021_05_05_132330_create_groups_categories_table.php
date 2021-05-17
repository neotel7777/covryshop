<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups_categories', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('group_id')->default(NULL);
            $table->integer('order')->default(NULL);
            $table->string('parameter',100)->default('');
            $table->string('name',100)->default('');
            $table->string('title',100)->default('');
            $table->string('page_title')->default('');
            $table->string('image')->default('');
            $table->text('description');
            $table->string('meta_title',150)->default('');
            $table->text('meta_description');
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
        Schema::dropIfExists('groups_categories');
    }
}
