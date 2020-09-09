<?php

namespace Marshmallow\Datasets\GoogleGeoTargets\Models;

use Marshmallow\Sluggable\HasSlug;
use Marshmallow\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Marshmallow\Datasets\GoogleGeoTargets\Models\GoogleGeoTargetType;

class GoogleGeoTarget extends Model
{
	use HasSlug;

	const CITY 						= 'City';
    const MUNICIPALITY 				= 'Municipality';
    const NEIGHBORHOOD 				= 'Neighborhood';
    const DISTRICT 					= 'District';
    const COUNTY 					= 'County';
    const REGION 					= 'Region';
    const CITY_REGION 				= 'City Region';
    const BOROUGH 					= 'Borough';
    const PROVINCE 					= 'Province';
    const UNIVERSITY 				= 'University';
    const AIRPORT 					= 'Airport';
    const STATE 					= 'State';
    const COUNTRY 					= 'Country';
    const DEPARTMENT 				= 'Department';
    const TERRITORY 				= 'Territory';
    const CANTON 					= 'Canton';
    const AUTONOMOUS_COMMUNITY 		= 'Autonomous Community';
    const UNION_TERRITORY 			= 'Union Territory';
    const PREFECTURE 				= 'Prefecture';
    const GOVERNORATE 				= 'Governorate';
    const POSTAL_CODE 				= 'Postal Code';
    const CONGRESSIONAL_DISTRICT	= 'Congressional District';
    const TV_REGION 				= 'TV Region';
    const OKRUG 					= 'Okrug';
    const NATIONAL_PARK 			= 'National Park';

    protected $guarded = [];

    public function cities()
    {
    	return $this->hasMany(self::class, 'parent_id', 'id')
                    ->select('google_geo_targets.*')
                    ->join(
                        'google_geo_target_types',
                        'google_geo_targets.google_geo_target_type_id',
                        '=',
                        'google_geo_target_types.id'
                    )
                    ->where(
                        'google_geo_target_types.google_name',
                        self::CITY
                    );
    }

    public function type()
    {
    	return $this->belongsTo(GoogleGeoTargetType::class, 'google_geo_target_type_id');
    }

    public function parent()
    {
    	return $this->belongsTo(self::class);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
