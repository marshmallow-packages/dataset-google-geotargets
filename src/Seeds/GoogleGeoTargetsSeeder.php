<?php

namespace Marshmallow\Datasets\GoogleGeoTargets\Seeds;

use Illuminate\Database\Seeder;
use Marshmallow\Datasets\Country\Models\Country;
use Marshmallow\Datasets\GoogleGeoTargets\Models\GoogleGeoTarget;
use Marshmallow\Datasets\GoogleGeoTargets\Models\GoogleGeoTargetType;

class GoogleGeoTargetsSeeder extends Seeder
{
	protected $file_name = 'geotargets-2020-03-03.csv';

	protected $target_types_available = [];

	protected $loop_count = 0;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$config = config('google-geotargets');
    	$countries_to_sync = (isset($config['countries'])) ? $config['countries'] : null;

    	$countries = Country::get()->pluck('id', 'alpha2')->toArray();
    	$this->startProgressBar();

    	$file = fopen($this->getFilePath(),"r");
		while (($data = fgetcsv($file)) !== FALSE) {
			$this->command->getOutput()->progressAdvance();

			$this->loop_count++;
			if ($this->loop_count == 1) {
				continue;
			}

			$data = $this->convertToNamedArray($data);

			if ($countries_to_sync && !in_array($data['country_code'], $countries_to_sync)) {
				continue;
			}

			if (!in_array($data['target_type'], $config['types'])) {
				continue;
			}

			$this->createType($data['target_type']);

			$geo_target_data = [
				'id' => $data['criteria_id'],
				'name' => $data['name'],
				'google_name' => $data['name'],
				'canonical_name' => $data['canonical_name'],
				'google_canonical_name' => $data['canonical_name'],
				'parent_id' => ($data['parent_id']) ? $data['parent_id'] : null,
				'country_id' => (isset($countries[$data['country_code']])) ? $countries[$data['country_code']] : null,
				'google_geo_target_type_id' => array_search($data['target_type'], $this->target_types_available),
				'status_string' => $data['status'],
				'status' => (strtolower($data['status']) == 'active') ? true : false,
			];

			$geo_target = GoogleGeoTarget::find($data['criteria_id']);
			if ($geo_target) {
				unset($geo_target_data['name']);
				unset($geo_target_data['canonical_name']);
			}

			GoogleGeoTarget::updateOrCreate(
				[
					'id' => $data['criteria_id'],
				],
				$geo_target_data
			);
		}

    	$this->command->getOutput()->progressFinish();
    }

    protected function convertToNamedArray($data)
    {
    	return [
			'criteria_id' => $data[0],
			'name' => $data[1],
			'canonical_name' => $data[2],
			'parent_id' => $data[3],
			'country_code' => $data[4],
			'target_type' => $data[5],
			'status' => $data[6],
		];
    }

    protected function createType($target_type_name)
    {
    	if (in_array($target_type_name, $this->target_types_available)) {
    		return;
    	}

		$target_type = GoogleGeoTargetType::updateOrCreate(
			[
				'google_name' => $target_type_name,
			],
			[
				'google_name' => $target_type_name,
				'name' => $target_type_name,
			]
		);
		$this->target_types_available[$target_type->id] = $target_type_name;
    }

    protected function getFilePath()
    {
    	return  __dir__ . '/../../resources/' . $this->file_name;
    }

    protected function startProgressBar()
    {
    	$targets = file_get_contents($this->getFilePath());
    	$targets = explode("\n", $targets);
    	$this->command->getOutput()->progressStart(count($targets));
    }
}
