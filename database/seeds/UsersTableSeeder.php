<?php 
 
use Illuminate\Database\Seeder;
use Faker\Factory;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
    	// menghapus seluruh data tabel users 
    	DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('users')->truncate();
           

    	// tambahkan 3 author ke dalam tabel users
    	$faker = Factory::create();
        
        DB::table('users')->insert([
    		[ 
    			'name'      => "godkuru",
                'slug'      => "kuru",
    			'email'     => "me@heaven.com",
    			'password'  => bcrypt('secret'),
                 'bio'        => $faker->text(rand(250, 300))

    		],
    		[ 
    			'name'       => "john doe",
                'slug'       => "john-doe",
    			'email'      => "john@gmail.com",
    			'password'   => bcrypt('secret'),
                 'bio'        => $faker->text(rand(250, 300))

    		],
    		[ 
    			'name'       => "Anton Sokolov",
                'slug'       => "anton-sokolov",
    			'email'      => "sokolov@gmail.com",
    			'password'   => bcrypt('secret'),
                'bio'        => $faker->text(rand(250, 300))
    		],
    	]);

    }
}