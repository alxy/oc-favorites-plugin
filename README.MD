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
Note: The Post model is extended to implement the behavior in Plugin.php
(see an example below):

```php
use Model;

class MyModel extends Model
{
    public $implement = ['Alxy.Favorites.Behaviors.Favoriteable'];
}
```

That's it ... your model is now **"Favoriteable"**!

## Usage

Add the FavoMatic plugin to your page/layout file to add features to your frontend.

The Favoriteable methods below are now available in your page and can be called via AJAX using the appropriate calls:

```html
data-request="onAddFavorite" data-request-data="id: {{post.id}}"
```

```html
data-request="onRemoveFavorite" data-request-data="id: {{post.id}}"
```

```html
data-request="onToggleFavorite" data-request-data="id: {{post.id}}"
```

### Using the FavoritePost Component with HTML

If you wish to use the default markup, you can include the component twig element in your Blog's Post loop. For example:

```
{% for post in posts %}
    <h1>{{ post.title }}</h1>
    {% component 'favoMatic' %}
{% endfor %}
```

This will render the 'onAddFavorite' and 'onToggleFavorite' methods for each post automatically. If you wish to override this default markup, create a 'favomatic' folder in your theme/partials directory and include the AJAX methods described in the previous section.

The models can be favored with and without an authenticated user
(see examples below):

### Add to favorites and remove from favorites:

If no param is passed to the favorite method, then the model will assume the authenticated user.

``` php
$post = Post::find(1);
$post->addFavorite(); // auth user added to favorites this post
$post->removeFavorite(); // auth user removed from favorites this post
$post->toggleFavorite(); // auth user toggles the favorite status from this post
```

You can also pass a user model directly to these methods. In this case, the given user will be used.

``` php
$post = Post::find(1);
$user = RainLab\Models\User::first();
$post->addFavorite($user); // user with that id added to favorites this post
$post->removeFavorite($user); // user with that id removed from favorites this post
$post->toggleFavorite($user); // user with that id toggles the favorite status from this post
```

The user model can also add to favorites and remove from favorites:

``` php
$user = User::first();
$post = Post::first();
$user->addFavorite($post); // The user added to favorites this post
$user->removeFavorite($post); // The user removed from favorites this post
$user->toggleFavorite($post); // The user toggles the favorite status from this post
```

### Return the favorite objects for the user:

A user can return the objects he marked as favorite. 
You just need to pass the **class** to the `favoritesOf()` method of the `User` model.

``` php
$user = Auth::getUser();
$user->favoritesOf(Post::class); // returns a collection of Posts the User has marked as favorite
```

### Return the favorites count from an object:

You can return the favorites count from an object, you just need to access the `favorites_count` attribute from the model

``` php
$post = Post::find(1);
$post->favorites_count; // returns the number of users that have marked as favorite this object.
```

### Return the users who marked this object as favorite

You can return the users who marked this object, you just need to call the `favoritedBy()` method in the object

``` php
$post = Post::find(1);
$post->favoritedBy(); // returns a collection with the Users that marked the post as favorite.
```

### Check if the user has favorited this Object

To return boolean value if the user has favorited the post object, you just need to call the `isFavorited()` method in the object.

``` php
$post = Post::find(1);
$post->isFavorited(); // returns a boolean value if auth user has favorited the post.
```

## Security

Please report any issue you find in the issues page.  
Pull requests are welcome.

## Credits

- [Christian Kuri](https://github.com/ChristianKuri)
