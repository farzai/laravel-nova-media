# Laravel Nova Media

[![Latest Version on Packagist](https://img.shields.io/packagist/v/farzai/laravel-nova-media.svg?style=flat-square)](https://packagist.org/packages/farzai/laravel-nova-media)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/farzai/laravel-nova-media/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/farzai/laravel-nova-media/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/farzai/laravel-nova-media/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/farzai/laravel-nova-media/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![codecov](https://codecov.io/gh/farzai/laravel-nova-media/branch/main/graph/badge.svg)](https://codecov.io/gh/farzai/laravel-nova-media)
[![Total Downloads](https://img.shields.io/packagist/dt/farzai/laravel-nova-media.svg?style=flat-square)](https://packagist.org/packages/farzai/laravel-nova-media)

This package is a Laravel Nova field for managing media files via [Spatie Media Library](https://spatie.be/docs/laravel-medialibrary/v10/introduction).


## Requirements
- PHP >= 8.1
- [Laravel Nova](https://nova.laravel.com/) >= 4.0
- [Spatie Media Library](https://spatie.be/docs/laravel-medialibrary/v10/introduction) >= 10.0

## Installation

You can install the package via composer:

```bash
composer require farzai/laravel-nova-media
```

## Usage

```php
use Farzai\NovaMedia\Fields\Media;

class Post extends Resource
{
    // ...

    public function fields(Request $request)
    {
        return [
            // ...

            Media::make('Images', 'cover')
                ->previewConversionName('preview')
                ->thumbnailConversionName('thumb'),
        ];
    }
}
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [parsilver](https://github.com/parsilver)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
