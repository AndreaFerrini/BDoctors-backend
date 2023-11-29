<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Typology;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TypologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('typologies') as $typology) {
            Typology::create($typology);
        }

        foreach (config('doctors_typologies') as $doctor_typology) {

            foreach (Typology::all() as $typology) {

                foreach (Doctor::all() as $doctor) {

                    if ($doctor['id'] == $doctor_typology['doctor_id'] && $typology['id'] == $doctor_typology['typology_id']) {
                        $typology->doctors()->attach($doctor->id);
                    }
                }

                $typology->save();
            }
        }
    }
}
