<?php

use Illuminate\Database\Seeder;
use App\Models\Kpi;

class KpiTableSeeder extends Seeder
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
					'name'        => 'Tỷ lệ chi phí tiết kiệm được',
					'code'        => 3,
					'unit'        => 1,
					'trend'       => 1,
					'percent'     => 20,
					'target'      => 5,
					'perform'     => 6,
					'per_perform' => 120,
					'score'      => 5,
					'efficiency'  => 120,
					'user_id'  => 1,
				],
				[
					'name'        => 'Doanh thu',
					'code'        => 4,
					'unit'        => 4,
					'trend'       => 1,
					'percent'     => 20,
					'target'      => 19,
					'perform'     => 18,
					'per_perform' => 94.74,
					// 'score'      => 5,
					// 'efficiency'  => 120,
					'user_id'  => 1,
				],
				[
					'name'        => 'Tỷ lệ khách hàng phàn nàn',
					'code'        => 1,
					'unit'        => 1,
					'trend'       => 2,
					'percent'     => 10,
					'target'      => 3,
					'perform'     => 4,
					'per_perform' => 75,
					// 'score'      => 5,
					// 'efficiency'  => 120,
					'user_id'  => 1,
				],
				[
					'name'        => 'Số lần hỗ trợ khách hàng chậm',
					'code'        => 2,
					'unit'        => 3,
					'trend'       => 2,
					'percent'     => 10,
					'target'      => 4,
					'perform'     => 4,
					'per_perform' => 100,
					// 'score'      => 5,
					// 'efficiency'  => 120,
					'user_id'  => 1,
				],
				[
					'name'        => 'Số lần đi làm muộn',
					'code'        => 5,
					'unit'        => 3,
					'trend'       => 2,
					'percent'     => 10,
					'target'      => 0,
					'perform'     => 0,
					// 'per_perform' => 120,
					// 'score'      => 5,
					// 'efficiency'  => 120,
					'user_id'  => 1,
				],
				[
					'name'        => 'Số vụ tai nạn lao động',
					'code'        => 6,
					'unit'        => 5,
					'trend'       => 2,
					'percent'     => 20,
					'target'      => 0,
					'perform'     => 0,
					// 'per_perform' => 120,
					// 'score'      => 5,
					// 'efficiency'  => 120,
					'user_id'  => 1,
				],
				[
					'name'        => 'Số khóa học đã hoàn thành',
					'code'        => 7,
					'unit'        => 2,
					'trend'       => 1,
					// 'percent'     => 10,
					// 'target'      => 5,
					// 'perform'     => 6,
					// 'per_perform' => 120,
					// 'score'      => 5,
					// 'efficiency'  => 120,
					'user_id'  => 1,
				]
			];

		foreach($array as $value) {
			Kpi::create($value);
		}
	}
}
