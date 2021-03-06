<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->truncate();

        // Create Admin RolesTableSeeder
        $admin  = new Role();
        $admin->name =  "admin";
        $admin->display_name =  "Admin";
        $admin->save();

        // Create Editor Role
        $editor  = new Role();
        $editor->name =  "editor";
        $editor->display_name =  "Editor";
        $editor->save();

        //Create Author RolesTableSeeder
        $author  = new Role();
        $author->name =  "author";
        $author->display_name =  "Author";
        $author->save();

        //Attach The Roles

        //first user as admin
        $user1  = User::find(1);
        $user1->detachRole($admin);
        $user1->attachRole($admin);
        //first user as editor
        $user2  = User::find(2);
        $user2->detachRole($editor);
        $user2->attachRole($editor);
        //thrid user as editor
        $user3  = User::find(3);
        $user3->detachRole($author);
        $user3->attachRole($author);
    }
}
