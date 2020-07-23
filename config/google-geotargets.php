<?php

use Marshmallow\Datasets\GoogleGeoTargets\Models\GoogleGeoTarget;

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
	    GoogleGeoTarget::MUNICIPALITY,
	    GoogleGeoTarget::NEIGHBORHOOD,
	    GoogleGeoTarget::DISTRICT,
	    GoogleGeoTarget::COUNTY,
	    GoogleGeoTarget::REGION,
	    GoogleGeoTarget::CITY_REGION,
	    GoogleGeoTarget::BOROUGH,
	    GoogleGeoTarget::PROVINCE,
	    GoogleGeoTarget::UNIVERSITY,
	    GoogleGeoTarget::AIRPORT,
	    GoogleGeoTarget::STATE,
	    GoogleGeoTarget::COUNTRY,
	    GoogleGeoTarget::DEPARTMENT,
	    GoogleGeoTarget::TERRITORY,
	    GoogleGeoTarget::CANTON,
	    GoogleGeoTarget::AUTONOMOUS_COMMUNITY,
	    GoogleGeoTarget::UNION_TERRITORY,
	    GoogleGeoTarget::PREFECTURE,
	    GoogleGeoTarget::GOVERNORATE,
	    GoogleGeoTarget::POSTAL_CODE,
	    GoogleGeoTarget::CONGRESSIONAL_DISTRICT,
	    GoogleGeoTarget::TV_REGION,
	    GoogleGeoTarget::OKRUG,
	    GoogleGeoTarget::NATIONAL_PARK,
	],
];
