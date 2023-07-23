<?php

namespace Database\Seeders;

use App\Models\Type;
use App\Models\Portfolio;
use App\Models\Technology;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PortfoliosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i = 0; $i < 50; $i++) {
            $types = Type::all();
            $name = $faker->words(rand(2, 4), true);
            $technologies = Technology::all()->pluck('id');
            $imageIndex = rand(0,6);
            $portfolio = Portfolio::create([
                'type_id' => $faker->randomElement($types)->id,
                'name' => Str::ucfirst($name),
                'client_name' => $faker->words(2, true),
                'url_image' => 'https://picsum.photos/id/' . rand(1, 270) . '/500/400',
                'image' => $imageIndex ? 'uploads/picsum' . $imageIndex . '.jpg' : null,
                'pickup_date' => $faker->date(),
                'deploy_date' => $faker->date(),
                'description' => $faker->paragraphs(rand(2, 20), true),
            ]);

            // associare il post ad un certo numero di tags
            $portfolio->technologies()->sync($faker->randomElements($technologies, rand(1, 4)));
        }
    }
}
