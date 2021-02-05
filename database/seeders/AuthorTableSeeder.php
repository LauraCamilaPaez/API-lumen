<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;
use Faker\Factory as Faker;


class AuthorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker=Faker::create();
        for ($i=0; $i<=50; $i++){
            Author::create([
                'name' =>$faker->name,
                'gender' =>$faker->randomElement(['male', 'female']),
                'country' =>$faker->country,
            ]);
        }
    }
}
