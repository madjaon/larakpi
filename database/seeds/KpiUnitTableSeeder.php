<?php

use Illuminate\Database\Seeder;
use App\Models\KpiUnit;

class KpiUnitTableSeeder extends Seeder
{
	/**
	* Run the database seeds.
	*
	* @return void
	*/
	public function run()
	{
		$array = ['%','Khóa','Lần','Triệu','Vụ'];

		foreach($array as $value) {
			KpiUnit::create(['name' => $value]);
		}
	}
}
