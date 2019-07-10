<?php

use Illuminate\Database\Seeder;
use App\Models\KpiCode;

class KpiCodeTableSeeder extends Seeder
{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run()
	{
		$array = [
					[
						'name'   => 'C1',
						// 'config' => '',
					],
					[
						'name'   => 'C2',
						// 'config' => '',
					],
					[
						'name'   => 'F1',
						// 'config' => '',
					],
					[
						'name'   => 'F2',
						// 'config' => '',
					],
					[
						'name'   => 'I1',
						'config' => '0-5|1-4|2-3|3-2|4-1|5-0',
					],
					[
						'name'   => 'I2',
						'config' => '0-3|1-2|2-1|3-0|4-0|5-0',
					],
					[
						'name'   => 'L1',
						// 'config' => '',
					],
					[
						'name'   => 'L2',
						// 'config' => '',
					],
					
			];

		foreach($array as $value) {
			KpiCode::create($value);
		}
	}
}
