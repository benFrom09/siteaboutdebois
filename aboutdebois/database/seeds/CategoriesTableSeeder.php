<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category::create([
            'name' => 'Paysages',
            'slug' => 'Paysages'
        ]);
        Category::create([
            'name' => 'Maisons',
            'slug' => 'Maisons'
        ]);
        Category::create([
            'name' => 'Personnages',
            'slug' => 'Personnages',
        ]);
        Category::create([
            'name' => 'Animaux',
            'slug' => 'Animaux',
        ]);
        Category::create([
            'name' => 'Végétation',
            'slug' => 'Végétation',
        ]);
    }
}