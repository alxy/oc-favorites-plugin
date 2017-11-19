<?php namespace Alxy\Favorites\Behaviors;

use October\Rain\Database\Collection;
use October\Rain\Extension\ExtensionBase;


class Favoriteability extends ExtensionBase
{
    /**
     * @var \October\Rain\Database\Model Reference to the extended model.
     */
    protected $model;

    /**
     * Constructor
     * @param \October\Rain\Database\Model $model The extended model.
     */
    public function __construct($model)
    {
        $this->model = $model;

        $this->model->hasMany['favorites'] = ['Alxy\Favorites\Models\Favorite'];
    }

    /**
     * Return a collection with the User favorited Model.
     * The Model needs to have the Favoriteable trait
     *
     * @param  $class *** Accepts for example: Post::class or 'App\Post' ****
     * @return Collection
     */
    public function favoritesOf($class)
    {
        return $this->model->favorites()->where('favoriteable_type', $class)->with('favoriteable')->get();
    }

    /**
     * Add the object to the User favorites.
     * The Model needs to have the Favoriteable behavior
     *
     * @param Object $object
     */
    public function addFavorite($object)
    {
        $object->addFavorite($this->model);
    }

    /**
     * Remove the Object from the user favorites.
     * The Model needs to have the Favoriteable behavior
     *
     * @param Object $object
     */
    public function removeFavorite($object)
    {
        $object->removeFavorite($this->model);
    }

    /**
     * Toggle the favorite status from this Object from the user favorites.
     * The Model needs to have the Favoriteable behavior
     *
     * @param Object $object
     */
    public function toggleFavorite($object)
    {
        $object->toggleFavorite($this->model);
    }

    /**
     * Check if the user has favorited this Object
     * The Model needs to have the Favoriteable behavior
     *
     * @param Object $object
     * @return boolean
     */
    public function isFavorited($object)
    {
        return $object->isFavorited($this->model);
    }

    /**
     * Check if the user has favorited this Object
     * The Model needs to have the Favoriteable behavior
     *
     * @param Object $object
     * @return boolean
     */
    public function hasFavorited($object)
    {
        return $object->isFavorited($this->model);
    }

}