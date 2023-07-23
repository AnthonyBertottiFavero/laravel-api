<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $technologies = [
            [
                'name' => 'HTML'
            ],
            [
                'name' => 'CSS'
            ],
            [
                'name' => 'JavaScript'
            ],
            [
                'name' => 'Vue JS'
            ],
            [
                'name' => 'Vite'
            ],
            [
                'name' => 'PHP'
            ],
            [
                'name' => 'Laravel'
            ],
            [
                'name' => 'C++'
            ],
            [
                'name' => 'Pyton'
            ],
            [
                'name' => 'Java'
            ],
        ];

        foreach ($technologies as $technology) {
            Technology::create($technology);
        }
    }
}
