<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('doctors') as $config_doctor) {
            $name = $config_doctor['name'];
            $slug = Doctor::slugger($name);

            Doctor::create([
                'user_id'       => $config_doctor['user_id'],
                'name'          => Str::ucfirst($name),
                'slug'          => $slug,
                'description'   => $config_doctor['description'],
                'address'       => $config_doctor['address'],
                'photo'         => $config_doctor['photo'],
                'visibility'    => $config_doctor['visibility'],
                
            ]);
        }
        
    }
}
