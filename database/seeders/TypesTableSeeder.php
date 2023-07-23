<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'Senza Categoria',
                'description' => 'Nessuna categoria associata.',
            ],

            [
                'name' => 'Full Stack',
                'description' => 'Tipo di sviluppo web che copre il Front End e il Back End.',
            ],

            [
                'name' => 'Front End',
                'description' => 'Tipo di sviluppo che copre solo il Front End, ovvero la parte visibile all\'utente.',
            ],

            [
                'name' => 'Back End',
                'description' => 'Tipo di sviluppo che copre solo il Back End, ovvero la parte non visibile all\'utente.',
            ],
        ];

        foreach ($types as $type) {
            Type::create($type);
        }
    }
}
