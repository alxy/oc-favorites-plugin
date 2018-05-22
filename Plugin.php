<?php namespace Alxy\Favorites;

use RainLab\User\Models\User;
use RainLab\Blog\Models\Post;
use System\Classes\PluginBase;

/**
 * Favorites Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * @var array Plugin dependencies
     */
    public $require = ['RainLab.User'];

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'Favorites',
            'description' => 'Adds a favorite feature to your October models.',
            'author'      => 'Alxy',
            'icon'        => 'icon-star'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {

        return [
            'Alxy\Favorites\Components\MakeFavorite' => 'makeFavorite',
        ];
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        // Extend Post model with behavior
        Post::extend(function($model) {
            // Implement behavior if not already implemented
            if (!$model->isClassExtendedWith('Alxy.Favorites.Behaviors.Favoriteable')) {
                $model->implement[] = 'Alxy.Favorites.Behaviors.Favoriteable';
            }
        });
    }

}
