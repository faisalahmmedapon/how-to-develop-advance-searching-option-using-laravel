<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\District;
use App\Models\Division;
use App\Models\Union;
use App\Models\Upazila;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        \App\Models\Category::factory(8)->create();
//        \App\Models\Post::factory(200)->create();



        $this->call([
            AdminSeeder::class,
        ]);



        // creating divisions
        foreach(tika_bd_divisions() as $division) {
            $divisionModel = new Division();
            $divisionModel->name = $division['name'];
            $divisionModel->status = 1;
            $divisionModel->save();
        }


        // creating districts
        foreach(tika_bd_districts() as $district) {
            $districtModel = new District();
            $districtModel->name = $district['name'];
            $districtModel->division_id = $district['division_id'];
            $districtModel->status = 1;
            $districtModel->save();
        }


        // creating upazilas
        foreach(tika_bd_upazilas() as $upazila) {
            $upazilaModel = new Upazila();
            $upazilaModel->name = $upazila['name'];
            $upazilaModel->district_id = $upazila['district_id'];
            $upazilaModel->status = 1;
            $upazilaModel->save();
        }
        // creating union
        foreach(tika_bd_unions() as $union) {
            $unionModel = new Union();
            $unionModel->name = $union['name'];
            $unionModel->upazilla_id = $union['upazilla_id'];
            $unionModel->status = 1;
            $unionModel->save();
        }




    }
}



