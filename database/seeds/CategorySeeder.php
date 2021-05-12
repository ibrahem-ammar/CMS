<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['un-categorized',1],
            ['natural',1],
            ['flowers',1],
            ['kitchen',0],
        ];

        foreach ($categories as $category) {
            Category::create(['name'=>$category[0],'status'=>$category[1] ]);
        }
    }
}
