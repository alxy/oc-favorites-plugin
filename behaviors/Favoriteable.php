<?php namespace Alxy\Favorites\Behaviors;

use Alxy\Favorites\Models\Favorite;
use Auth;
use October\Rain\Database\Collection;
use October\Rain\Extension\ExtensionBase;
use RainLab\User\Models\User;


class Favoriteable extends ExtensionBase
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

        $this->model->morphMany['favorites'] = ['Alxy\Favorites\Models\Favorite', 'name' => 'favoriteable'];
    }

    /**
     * Add this Object to the user favorites
     *
     * @param   User|null   $user   (if null it is added to the authenticated user)
     */
    public function addFavorite(User $user = null)
    {
        $user = $user ? $user : Auth::getUser();

        // Make sure the object isn't favorited already, as it leads to database errors
        if(! $this->model->isFavorited($user)) {
            $favorite = new Favorite(['user_id' => ($user->id) ? $user->id : Auth::getUser()->id]);
            $this->model->favorites()->save($favorite);
        }
    }

    /**
     * Remove this Object from the user favorites
     *
     * @param   User|null   $user   (if null it is added to the authenticated user)
     *
     */
    public function removeFavorite(User $user = null)
    {
        $user = $user ? $user : Auth::getUser();
        $this->model->favorites()->where('user_id', $user->id)->delete();
    }

    /**
     * Toggle the favorite status from this Object
     *
     * @param   User|null   $user   (if null it is added to the authenticated user)
     */
    public function toggleFavorite(User $user = null)
    {
        $this->model->isFavorited($user) ? $this->model->removeFavorite($user) : $this->model->addFavorite($user) ;
    }

    /**
     * Check if the user has favorited this Object
     *
     * @param   User|null   $user   (if null it is added to the authenticated user)
     * @return boolean
     */
    public function isFavorited(User $user = null)
    {
        $user = $user ? $user : Auth::getUser();
        return $this->model->favorites()->where('user_id', $user->id)->exists();
    }

    /**
     * Return a collection with the Users who marked as favorite this Object.
     *
     * @return Collection
     */
    public function favoritedBy()
    {
        return $this->model->favorites()->with('user')->get()->mapWithKeys(function ($item) {
            return [$item['user']];
        });
    }

    /**
     * Count the number of favorites
     *
     * @return int
     */
    public function getFavoritesCountAttribute()
    {
        return $this->model->favorites()->count();
    }


}