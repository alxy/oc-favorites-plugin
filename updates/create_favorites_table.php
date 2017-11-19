<?php namespace Alxy\Favorites\Updates;

use Schema;
use October\Rain\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class CreateFavoritesTable extends Migration
{
    public function up()
    {
        Schema::create('alxy_favorites_favorites', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('user_id')->unsigned()->index();
            $table->morphs('favoriteable');

            $table->primary(['user_id', 'favoriteable_id', 'favoriteable_type'], 'id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alxy_favorites_favorites');
    }
}
