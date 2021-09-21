<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('lt_LT');

        DB::table('users')->insert(
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('adminAdmin'),
            ]
        );
        $species = ['Šuo', 'Katė', 'Žiurkėnas', 'Varlė', 'Driežas', 'Žirgas', 'Jūrų kiaulytė', 'Triušis', 'Višta', 'Laboratorinė žiurkė', 'Šeškas', 'Gyvatė', 'Bezdžionė', 'Papūga'];
        $doctorsCount = 30;
        $category = ['Pediatras', 'Psichiatras', 'Chirurgas', 'Bendrosios praktikos', 'Odontologas', 'Kardiologas', 'Dietologas'];
        foreach (range(1, $doctorsCount) as $_) {
            DB::table('doctors')->insert([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'category' => $category[rand(1, count($category) - 1)],
            ]);
        }


        foreach (range(1, 120) as $_) {
            DB::table('owners')->insert([
                'name' => $faker->firstName(),
                'surname' => $faker->lastName(),
                'contacts' => $faker->realText(rand(20, 150)),

            ]);
        }

        foreach (range(1, 200) as $_) {
            DB::table('pets')->insert([
                'name' => $faker->firstName(),
                'species' => $species[rand(1, count($species) - 1)],
                'birth_date' => rand(1999, 2022),
                'document' => 'card',
                'history' => $faker->realText(rand(50, 500)),
                'doctor_id' => rand(1, $doctorsCount),
                'owner_id' => rand(1, 120),
            ]);
        }
    }
}