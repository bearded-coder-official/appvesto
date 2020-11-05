<?php

use App\Models\Entities\News;
use Illuminate\Database\Seeder;

class NewsDemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach(range(0, 200) as $a){
            News::create([
                'title' => $faker->sentence(10),
                'content' => $faker->text(400),
                'url' => $faker->url,
            ]);
        }

    }
}
