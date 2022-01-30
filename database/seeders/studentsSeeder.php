<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\School;
use App\Models\Student;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;
class studentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (School::all() as $one){
            for($i=0;$i<1000;$i++){
                $faker= Factory::create();
                $student=new Student;
                $student->name=$faker->name();
                $student->email=$i.$one->id.$faker->email();
                $student->password= Hash::make('12345678');
                $student->school_id=$one->id;
                $student->save();
            }
        }
    }
}
