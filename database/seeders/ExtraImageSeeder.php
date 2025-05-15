<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ExtraImage;

class ExtraImageSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $image = ExtraImage::create([
                'title' => "Immagine {$i}",
            ]);

            $imagePath = public_path("placeholder/Immagine_{$i}.svg");

            if (file_exists($imagePath)) {
                $image->addMedia($imagePath)
                      ->preservingOriginal()
                      ->toMediaCollection('images');
            }
        }
    }
}

