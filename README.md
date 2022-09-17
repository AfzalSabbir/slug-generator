# slug-generator

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Travis](https://img.shields.io/travis/afzalsabbir/slug-generator.svg?style=flat-square)]()
[![Total Downloads](https://img.shields.io/packagist/dt/afzalsabbir/slug-generator.svg?style=flat-square)](https://packagist.org/packages/afzalsabbir/slug-generator)

## Install

```php
composer require afzalsabbir/slug-generator
```

## Usage

- Using this package is very simple. Just use the `SlugGenerator` trait in your model and it'll automatically generate a
  slug for you.
- You can also use the `generateSlug(Model $model)` method to generate a slug.
- Publish the config file to customize the slug generation.
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
        protected $slug = [
            "set-on-create" => true, // Whether to set the slug when the model is created
            "set-on-update" => false, // Whether to update the slug when the target field is updated
            "target-field"  => "title", // The field that will be used to generate the slug
            "separator"     => "-", // The separator that will be used to separate the words
            "slug-field"    => "slug", // The field that will be used to store the slug
        ];
  
        // ...
    }
    ```

```php
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
