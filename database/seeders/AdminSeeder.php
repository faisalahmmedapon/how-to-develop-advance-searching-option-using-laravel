<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
        $admin->name = "Faisal Ahmmed";
        $admin->email = "developerfaisal32@gmail.com";
        $admin->phone = "+8801307788699";
        $admin->password = Hash::make('12345678');
        $admin->save();

    }
}
