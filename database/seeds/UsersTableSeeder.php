<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::Truncate();
        Role::truncate();

        $adminRole = Role::create(["name" => "root"]);
        $studentRole = Role::create(["name" => "student"]);

        $user = new User;
        $user->name = "root";
        $user->email = "root@gmail.com";
        $user->password = bcrypt("root");
        $user->save();

        $user->assignRole($adminRole);


    }
}
