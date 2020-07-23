![alt text](https://cdn.marshmallow-office.com/media/images/logo/marshmallow.transparent.red.png "marshmallow.")

# Laravel Google Geo Targets
This dataset contains all the geo location from Google. We update the source when Google publishes a new one and you can reseed your data. By default only the Netherlands is imported but you can change this in the config if you want to.

### Installatie
```
composer require marshmallow/dataset-google-geotargets
```

# Migrate
Run `php artisan migrate` to create the database schema's.

# Publish the config
Publish the config so you are able to choose which countries will be seeded to the table and which data types will be seeded. By default this is set to The Nederlands and data types. If you want this to be seeded, you don't need to publish the config.
```bash
php artisan vendor:publish --provider="Marshmallow\Datasets\GoogleGeoTargets\ServiceProvider"
```

```php
return [

	/**
	 * Specify the countries you wish to sync. An empty array will
	 * result in the seeder seeding all the data.
	 */
	'countries' => [
		'NL',
	],

	/**
	 * Specify the types you wish to sync.
	 */
	'types' => [
		GoogleGeoTarget::CITY,
		// ...
	]
];
```

# Seed the table
We need to seed to tables, the country table and the Google Geo Target tables.
```bash
# Seed the country table.
php artisan db:seed --class="Marshmallow\Datasets\Country\Seeders\CountrySeeder"

# Seed the Google Geo Target table
php artisan db:seed --class="Marshmallow\Datasets\GoogleGeoTargets\Seeds\GoogleGeoTargetsSeeder"
```

# Usage
```php
$country = Country::alpha2('NL');
$country->provinces->first()->cities->first()->name;
```

- - -

Copyright (c) 2020 marshmallow
