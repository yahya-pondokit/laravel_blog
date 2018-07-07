<?php

use Illuminate\Database\Seeder;
use App\Post;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        DB::table('categories')->insert([
            [
                'title' =>  'Uncategorized',
                'slug'  =>  'uncategorized'
            ],
            [
                'title' =>  'Web Design',
                'slug'  =>  'web-design'
            ],
        	[
        		'title'	=>	'Web Programing',
        		'slug'	=>	'web-programing'
        	],
        	[
        		'title'	=>	'Internet',
        		'slug'	=>	'internet'
        	],
            [
                'title' =>  'Social',
                'slug'  =>  'social'
            ],
        	[
        		'title'	=>	'Freebies',
        		'slug'	=>	'freebies'
        	],
        ]);

        foreach (Post::pluck('id') as $postId)
        {
            $categories = Category::pluck('id');
            $categoryId = $categories[rand(0, $categories->count()-1)];

            DB::table('posts')
            ->where('id', $postId)
            ->update(['category_id' => $categoryId]);  
        }

    }
}
