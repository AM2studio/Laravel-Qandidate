# Qandidate Laravel

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

This is a service provider for [Qandidate](https://github.com/qandidate-labs/qandidate-toggle) package

## Install

Via Composer

``` bash
$ composer require am2studio/laravel-qandidate
```

Register service provider in your `app.php`

```php
'AM2Studio\LaravelQandidate\LaravelQandidateServiceProvider',
```

Register the facade in your `app.php`

```php
'Qandidate' => 'AM2Studio\LaravelQandidate\QandidateFacade',
```

Publish migration file and run migration

```php
php artisan vendor:publish --provider="AM2Studio\LaravelQandidate\LaravelQandidateServiceProvider" --tag="migrations"
php artisan migrate
```

This package already has a simple CRUD for qandidate and can be accessed through /qandidate/toggle. If you wish to change the prefix or even create your own routes you can publish config file

```php
php artisan vendor:publish --provider="AM2Studio\LaravelQandidate\LaravelQandidateServiceProvider" --tag="config"
```

and disable default routes through defaultRoutes variable or change default prefix through routePrefix variable. If you decide to use defult routes but want to add middleware you can do so through middlewares variable.

If you don't like default templates, publish views and make changes accordingly.
```php
php artisan vendor:publish --provider="AM2Studio\LaravelQandidate\LaravelQandidateServiceProvider" --tag="views"
```



## Usage

``` php
Qandidate::active($featureName, $attributes);
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Credits

- [Marko Šamec][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/am2studio/laravel-qandidate.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/am2studio/laravel-qandidate/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/am2studio/laravel-qandidate.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/am2studio/laravel-qandidate.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/am2studio/laravel-qandidate.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/am2studio/laravel-qandidate
[link-downloads]: https://packagist.org/packages/am2studio/laravel-qandidate
[link-author]: https://github.com/msamec
[link-contributors]: ../../contributors
