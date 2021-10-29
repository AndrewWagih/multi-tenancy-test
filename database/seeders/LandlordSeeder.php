<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenant;
class LandlordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tenant::create([
            'name' => 'test1',
            'domain' => 'test.com',
            'database' => 'test1',
        ]);

        Tenant::create([
            'name' => 'test2',
            'domain' => 'testtwo.com',
            'database' => 'test2',
        ]);
    }
}
