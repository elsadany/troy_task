<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Models\School;
class schoolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=0;$i<3;$i++){
        $faker = Factory::create();
            $school=new School;
            $school->name=$faker->name();
            $school->save();
        }
    }
}
