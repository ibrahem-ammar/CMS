<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $adminRole = Role::create(['name'=>'admin','display_name'=>'adminstrator','description'=>'system adminstrator','allowed_route'=>'admin']);
        $editorRole = Role::create(['name'=>'editor','display_name'=>'supervisor','description'=>'system supervisor','allowed_route'=>'admin']);
        $userRole = Role::create(['name'=>'user','display_name'=>'user','description'=>'normal user','allowed_route'=> null]);

        $admin = User::create([
            'name'  =>'admin',
            'username'  =>'admin',
            'email' =>'admin@email.com',
            'mobile'    =>'12345678',
            'email_verified_at' =>Carbon::now(),
            'password'  =>bcrypt('12345678'),
            'status'    =>'1',
            'receive_email' =>'0',
        ]);

        $admin->attachRole($adminRole);


        $editor = User::create([
            'name'  =>'editor',
            'username'  =>'editor',
            'email' =>'editor@email.com',
            'mobile'    =>'12345679',
            'email_verified_at' =>Carbon::now(),
            'password'  =>bcrypt('12345678'),
            'status'    =>'1',
            'receive_email' =>'0',
        ]);

        $editor->attachRole($editorRole);

        $user1 = User::create([
            'name'  =>'user',
            'username'  =>'user',
            'email' =>'user@email.com',
            'mobile'    =>'12345675',
            'email_verified_at' =>Carbon::now(),
            'password'  =>bcrypt('12345678'),
            'status'    =>'1',
            'receive_email' =>'0',
        ]);

        $user1->attachRole($userRole);

        $user2 = User::create([
            'name'  =>'ali',
            'username'  =>'ali',
            'email' =>'ali@email.com',
            'mobile'    =>'12345674',
            'email_verified_at' =>Carbon::now(),
            'password'  =>bcrypt('12345678'),
            'status'    =>'1',
            'receive_email' =>'0',
        ]);

        $user2->attachRole($userRole);

        $user3 = User::create([
            'name'  =>'ahmed',
            'username'  =>'ahmed',
            'email' =>'ahmed@email.com',
            'mobile'    =>'12345672',
            'email_verified_at' =>Carbon::now(),
            'password'  =>bcrypt('12345678'),
            'status'    =>'1',
            'receive_email' =>'0',
        ]);

        $user3->attachRole($userRole);

        for ($i=0; $i < 20 ; $i++) {
            $user = User::create([
                'name'  =>$faker->name(),
                'username'  =>$faker->userName,
                'email' =>$faker->email,
                'mobile'    =>$faker->phoneNumber,
                'email_verified_at' =>Carbon::now(),
                'password'  =>bcrypt('12345678'),
                'status'    =>rand(0,1),
                'receive_email' =>'0',
            ]);

            $user->attachRole($userRole);
        }



    }
}
