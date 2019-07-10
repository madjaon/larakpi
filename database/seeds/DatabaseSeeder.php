<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(ConnectRelationshipsSeeder::class);
        $this->call(ThemesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        
        $this->call(KpiUnitTableSeeder::class);
        $this->call(KpiCodeTableSeeder::class);
        $this->call(KpiTableSeeder::class);
        $this->call(KpiEfficiencyTableSeeder::class);

        Model::reguard();
    }
}
