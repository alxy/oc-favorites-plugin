<?php namespace Alxy\Favorites\Models;

use Model;

/**
 * Favorite Model
 */
class Favorite extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'alxy_favorites_favorites';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = ['user_id'];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [
        'user' => 'RainLab\User\Models\User'
    ];
    public $belongsToMany = [];
    public $morphTo = [
        'favoriteable' => []
    ];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];
}
