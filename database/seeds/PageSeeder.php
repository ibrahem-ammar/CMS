<?php

use App\Models\Page;
use Faker\Factory;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $pages = ['about us','our vision'];
        foreach ($pages as $page) {
            Page::create([
                'title' => $page,
                'content' => $faker->paragraph(),
                'status' => 1,
                'type' => 'page',
                'comment_able' => 0,
                'user_id' => 1,
                'category_id' => 1,
            ]);
        }
    }
}
