![alt text](https://cdn.marshmallow-office.com/media/images/logo/marshmallow.transparent.red.png "marshmallow.")

# Laravel Google Geo Targets

[![Latest Version on Packagist](https://img.shields.io/packagist/v/marshmallow/dataset-google-geotargets.svg?style=flat-square)](https://packagist.org/packages/marshmallow/dataset-google-geotargets)
[![Tests](https://img.shields.io/github/actions/workflow/status/marshmallow-packages/dataset-google-geotargets/php-syntax-checker.yml?branch=main&label=tests&style=flat-square)](https://github.com/marshmallow-packages/dataset-google-geotargets/actions/workflows/php-syntax-checker.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/marshmallow/dataset-google-geotargets.svg?style=flat-square)](https://packagist.org/packages/marshmallow/dataset-google-geotargets)

Import all GeoTargets from Google into your Laravel project.

This dataset contains all the geo locations from Google. We update the source when Google publishes a new one and you can reseed your data. By default only the Netherlands is imported, but you can change this in the config if you want to.

## Installation

Install the package via Composer:

```bash
composer require marshmallow/dataset-google-geotargets
```

The service provider is registered automatically through Laravel package discovery.

### Publish and run the migrations

Before you run the migration, publish the migrations first:

```bash
php artisan vendor:publish --provider="Marshmallow\Datasets\GoogleGeoTargets\ServiceProvider" --tag="migrations"
```

Run the migrations to create the database schema:

```bash
php artisan migrate
```

### Publish the config

Publish the config so you are able to choose which countries will be seeded to the table and which data types will be seeded. By default this is set to the Netherlands and all data types. If the defaults work for you, you don't need to publish the config.

```bash
php artisan vendor:publish --provider="Marshmallow\Datasets\GoogleGeoTargets\ServiceProvider"
```

## Configuration

The published `config/google-geotargets.php` file exposes the following options:

| Key | Default | Description |
| --- | --- | --- |
| `countries` | `['NL']` | Alpha-2 country codes you wish to sync. An empty array seeds all countries. |
| `types` | All `GoogleGeoTarget` type constants | The geo target types you wish to sync. |

The available type constants live on `Marshmallow\Datasets\GoogleGeoTargets\Models\GoogleGeoTarget`, for example `GoogleGeoTarget::CITY`, `GoogleGeoTarget::PROVINCE`, `GoogleGeoTarget::COUNTRY`, `GoogleGeoTarget::AIRPORT` and more.

## Seed the tables

You need to seed two tables: the country table and the Google Geo Target table.

```bash
# Seed the country table.
php artisan db:seed --class="Marshmallow\Datasets\Country\Seeders\CountrySeeder"

# Seed the Google Geo Target table.
php artisan db:seed --class="Marshmallow\Datasets\GoogleGeoTargets\Seeds\GoogleGeoTargetsSeeder"
```

## Usage

Each `GoogleGeoTarget` is related to its `type`, its `parent`, and its child `cities`:

```php
use Marshmallow\Datasets\Country\Models\Country;
use Marshmallow\Datasets\GoogleGeoTargets\Models\GoogleGeoTarget;

$country = Country::alpha2('NL');
$country->provinces->first()->cities->first()->name;

// Resolve the type of a geo target.
$target = GoogleGeoTarget::first();
$target->type->name;
```

## Security Vulnerabilities

Please report security vulnerabilities by email to [stef@marshmallow.dev](mailto:stef@marshmallow.dev) rather than via the public issue tracker.

## Credits

- [Stef](https://marshmallow.dev)
- [All Contributors](https://github.com/marshmallow-packages/dataset-google-geotargets/contributors)

## License

The MIT License (MIT). Please see the [License File](LICENSE) for more information.
