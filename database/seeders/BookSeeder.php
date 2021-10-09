<?php

namespace Database\Seeders;

use App\Models\Book;
use Faker\Factory;
use Faker\Provider\en_US\Text;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $faker->addProvider(Text::class);

        for ($i = 1; $i <= 1000; $i++) {
            Book::create([
                'title' => $faker->text(20),
                'description' => $faker->text,
                'pages' => $faker->numberBetween(200, 500),
                'release_date' => $faker->date,
                'author_id' => $i
            ]);
        }
    }
}
