<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Experto;


class ExpertosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Inserta los 3 expertos en la base datos
        Experto::insert([
            [
                'nombre' => 'Experto 1',
                'email' => 'experto1@iahorro.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Experto 2',
                'email' => 'experto2@iahorro.com',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Experto 3',
                'email' => 'experto3@iahorro.com',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
