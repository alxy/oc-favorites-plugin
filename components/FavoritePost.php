<?php namespace Alxy\Favorites\Components;

use Cms\Classes\ComponentBase;
use Auth;
use RainLab\User\Models\User;
use RainLab\Blog\Models\Post;

class FavoritePost extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Favorite Posts Component',
            'description' => 'Inject Blog Post Favoriteability into pages.'
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function boot() {
        
    }

    public function onAddFavorite($id = null) {

        $user = Auth::getUser();

        if(!isset($id))
            $id = post('id');
        
        $post = Post::where('id', '=', $id)->first();

        $post->addFavorite($user);

        return;
    }

    public function onRemoveFavorite($id = null) {

        $user = Auth::getUser();

        if(!isset($id))
            $id = post('id');
        
        $post = Post::where('id', '=', $id)->first();

        $post->removeFavorite($user);

        return;
    }

    public function onToggleFavorite($id = null) {

        $user = Auth::getUser();

        if(!isset($id))
            $id = post('id');
        
        $post = Post::where('id', '=', $id)->first();

        $post->toggleFavorite($user);

        return;
    }
}
