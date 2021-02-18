<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('price');
            $table->text('description');
            $table->boolean('status')->default(1);
            $table->foreignId('menu_category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('menu_pictures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained()->onDelete('cascade');
            $table->string('url');
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
        // Schema::dropIfExists('menu');
        Schema::disableForeignKeyConstraints();
        Schema::table('menus', function(Blueprint $table){
            $table->dropForeign(['menu_category_id']);
        });
        Schema::table('menu_pictures', function(Blueprint $table){
            $table->dropForeign(['menu_id']);
        });

        Schema::dropIfExists('menu_pictures');
        Schema::dropIfExists('menus');
        Schema::enableForeignKeyConstraints();
    }
}
