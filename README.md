# Self Healing URLs

> This package was originally written by [Luke Downing](https://github.com/lukeraymonddowning).


Self Healing URLs is a simple Laravel package inspired by [this video from Aaron Francis](https://www.youtube.com/watch?v=a6lnfyES-LA&t=554s).

It allows you to mark Eloquent models as self-healing so that the URLs generated for said
models can include an SEO friendly slug whilst not breaking should the slug alter in any way.

## Installation

The package can be installed via Composer:

```
composer require levintoo/self-healing-urls
```

Once installed, add the `HasSelfHealingUrls` trait to any Eloquent model:

```php
use Levintoo\SelfHealingUrls\Concerns\HasSelfHealingUrls;

class Post extends Model
{
    use HasSelfHealingUrls;
}
```

If your model has a column named `slug`, you're all set. Otherwise, define
a `$slug` property on your model to inform the package which column to use instead:

```php
use Levintoo\SelfHealingUrls\Concerns\HasSelfHealingUrls;

class Post extends Model
{
    use HasSelfHealingUrls;
    
    protected $slug = 'title';
}
```

Don't worry if your "slug" isn't URL friendly; the package will take care of
formatting it for you. In fact, it doesn't even have to be unique because the
defined unique identifier for your model will also be included at the end.

## Limitations

By default, the package requires that your unique identifier (such as the `id` or `uuid` column)
not have any `-` characters. You can implement your own `IdentifierHandler` as detailed in the next section.

Unless you implement a custom `Rerouter`, the package requires that you have
defined names to the routes you want to use with self healing URLs.

## Using a custom `IdentifierHandler`

If you need to customize how a slug is joined to a model identifier (which by default is just a hyphen),
you can create your own class implementing `IdentifierHandler` and register it in the register
method of your `AppServiceProvider`.

Here is an example using an `_` instead of a hyphen:

```php
class UnderscoreIdentifierHandler implements IdentifierHandler
{
    public function joinToSlug(string $slug, string|int $identifier): string
    {
        return "{$slug}_{$identifier}";
    }

    public function separateFromSlug(string $value): string
    {
        return Str::afterLast($value, '_');
    }
}
```

Register the custom handler in your `AppServiceProvider` like so:

```php
class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(IdentifierHandler::class, UnderscoreIdentifierHandler::class);
    }
}
```

## Attributions

Without [Aaron's video](https://www.youtube.com/watch?v=a6lnfyES-LA&t=554s), I wouldn't have even thought about this, so props to him. Go watch the video.

