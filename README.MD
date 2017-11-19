# October Favorite Plugin


**Allows October models to implement a 'favorite' or 'remember' or 'follow' feature. Note that this plugin ports the original [christiankuri/laravel-favorite](https://github.com/ChristianKuri/laravel-favorite) to October.**

## Index

- [Installation](#installation)
- [Models](#models)
- [Usage](#usage)
- [Security](#security)
- [Credits](#credits)

## Installation

1) Make sure to install the required ``RainLab.User`` plugin.

```bash
$ php artisan plugin:install RainLab.User
```

2) Install this plugin from the backend or directly via artisan.

```bash
$ php artisan plugin:install Alxy.Favorites
```

## Models

Your models should import the `Alxy.Favorites.Behaviors.Favoriteable` behavior. That will have the methods that you'll use to allow the model be favoriteable.
In all the examples I will use the Post model as the model that is 'Favoriteable', thats for example propuses only.
(see an example below):

```php
use Model;

class Post extends Model
{
    public $implement = ['Alxy.Favorites.Behaviors.Favoriteable'];
}
```

That's it ... your model is now **"Favoriteable"**!

## Usage

The models can be favored with and without an authenticated user
(see examples below):

### Add to favorites and remove from favorites:

If no param is passed to the favorite method, then the model will assume the authenticated user.

``` php
$post = Post::find(1);
$post->addFavorite(); // auth user is added to favorites of this post
$post->removeFavorite(); // auth user is removed from favorites of this post
$post->toggleFavorite(); // toggles the favorite status of this post
```

You can also pass a user model directly to these methods. In this case, the given user will be used.

``` php
$post = Post::find(1);
$user = RainLab\Models\User::first();
$post->addFavorite($user);
$post->removeFavorite($user);
$post->toggleFavorite($user);
```

The user model can also add to favorites and remove from favorites:

``` php
$user = User::first();
$post = Post::first();
$user->addFavorite($post);
$user->removeFavorite($post);
$user->toggleFavorite($post);
```

### Return the favorite objects for the user:

A user can return the objects he marked as favorite. 
You just need to pass the **class** to the `favoritesOf()` method of the `User` model.

``` php
$user = Auth::getUser();
$user->favoritesOf(Post::class); // returns a collection of Posts the User has marked as favorite
```

### Return the favorites count from an object:

To return the favorites count from an object, you just need to access the `favorites_count` attribute from the model.

``` php
$post = Post::find(1);
$post->favorites_count; // returns the number of users that have marked as favorite this object.
```

### Return the users who marked this object as favorite

To return the users who favored this object, you just need to call the `favoritedBy()` method in the object.

``` php
$post = Post::find(1);
$post->favoritedBy(); // returns a collection with the Users that marked the post as favorite.
```

## Security

Please report any issue you find in the issues page.  
Pull requests are welcome.

## Credits

- [Christian Kuri](https://github.com/ChristianKuri)
