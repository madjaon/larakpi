<?php

use Illuminate\Database\Seeder;
use App\Models\KpiEfficiency;

class KpiEfficiencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		KpiEfficiency::create(['user_id' => 1]);
    }
}
