<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Sponsor;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SponsorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('sponsors') as $sponsor) {
            Sponsor::create($sponsor);
        }

        foreach (config('doctors_sponsors') as $doctor_sponsor) {

            foreach (Sponsor::all() as $sponsor) {

                foreach (Doctor::all() as $doctor) {

                    if ($doctor['id'] == $doctor_sponsor['doctor_id'] && $sponsor['id'] == $doctor_sponsor['sponsor_id']) {
                        $sponsor->doctors()->attach($doctor->id);
                    }
                }

                $sponsor->save();
            }
        }
    }
}
