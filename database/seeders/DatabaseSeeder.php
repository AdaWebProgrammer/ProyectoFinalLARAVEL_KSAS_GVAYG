<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Shoe;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Shoe::create([
            'title' => 'Zapato deportivo',
            'description' => 'Zapato ideal para correr largas distancias.',
            'image' => 'https://example.com/image1.png',
            'thumbnail' => 'https://example.com/thumbnail1.png'
        ]);

        Shoe::create([
            'title' => 'Zapato casual',
            'description' => 'Zapato cómodo para uso diario.',
            'image' => 'https://example.com/image2.png',
            'thumbnail' => 'https://example.com/thumbnail2.png'
        ]);

        Shoe::create([
            'title' => 'Zapato formal',
            'description' => 'Zapato elegante para eventos formales.',
            'image' => 'https://example.com/image3.png',
            'thumbnail' => 'https://example.com/thumbnail3.png'
        ]);
    

    }
}
