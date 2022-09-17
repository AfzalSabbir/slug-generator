# SlugGenerator - Laravel Slug Generator
> A Laravel package to generate slugs for your models.

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/afzalsabbir/slug-generator/master.svg?style=flat-square)](https://travis-ci.org/afzalsabbir/slug-generator)
[![Quality Score](https://img.shields.io/scrutinizer/g/afzalsabbir/slug-generator.svg?style=flat-square)](https://scrutinizer-ci.com/g/afzalsabbir/slug-generator)

[![Latest Stable Version](https://img.shields.io/packagist/v/afzalsabbir/slug-generator.svg?style=flat-square)](https://packagist.org/packages/afzalsabbir/slug-generator)
[![Latest Unstable Version](https://img.shields.io/packagist/vpre/afzalsabbir/slug-generator.svg?style=flat-square)](https://packagist.org/packages/afzalsabbir/slug-generator)
[![Total Downloads](https://img.shields.io/packagist/dt/afzalsabbir/slug-generator.svg?style=flat-square)](https://packagist.org/packages/afzalsabbir/slug-generator)

## Installation

You can install the package via composer:

```php
composer require afzalsabbir/slug-generator
```

## Usage

- Using this package is very simple. Just use the `SlugGenerator` trait in your model and it'll automatically generate a
  slug for you. It'll use default configuration.
    ```php
    // ...
    use AfzalSabbir\SlugGenerator\SlugGenerator;
    use Illuminate\Database\Eloquent\Model;
    // ...

    class Post extends Model
    {
        // ...
        use SlugGenerator;
        // ...
    }
    ```
- Publish the config file to customize the slug generation. \
  <sup>_[**Note:** if facing any issue run `php artisan vendor:publish` and find `AfzalSabbir\SlugGenerator\SlugGeneratorServiceProvider` to publish]_</sup>
    ```php
    php artisan vendor:publish --provider="AfzalSabbir\SlugGenerator\SlugGeneratorServiceProvider" --tag="config"
    ```
- You can also configure the slug generation in your model.
    ```php
    namespace App\Models;
  
    use AfzalSabbir\SlugGenerator\SlugGenerator;
    use Illuminate\Database\Eloquent\Model;
    // ...
    
    class Post extends Model
    {
        // ...
        use SlugGenerator;
    
        // ...
        protected $slugGenerator = [
            "set-on-create" => true, // Whether to set the slug when the model is created
            "set-on-update" => false, // Whether to update the slug when the target field is updated
            "target-field"  => "title", // The field that will be used to generate the slug
            "separator"     => "-", // The separator that will be used to separate the words
            "slug-field"    => "slug", // The field that will be used to store the slug
        ];
  
        // ...
    }
    ```
- You can also use the `generateSlug(Model $model)` helper method to generate a slug.
    ```php
    use AfzalSabbir\SlugGenerator\SlugGenerator;
    use App\Models\Post;
    // ...
    
    $post = Post::find(1);
    $post->title = "Hello World";
    $post->slug = generateSlug($post);
    $post->save();
    ```

## Testing

Run the tests with:

```bash
vendor/bin/phpunit
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security-related issues, please email afzalbd1@gmail.com instead of using the issue tracker.

## License

The MIT License (MIT). Please see [License File](/LICENSE.md) for more information.
