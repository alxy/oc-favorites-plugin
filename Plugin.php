<?php namespace Alxy\Favorites;

use RainLab\User\Models\User;
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
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        User::extend(function($model) {
            $model->implement[] = 'Alxy.Favorites.Behaviors.Favoriteability';
        });
    }

}
