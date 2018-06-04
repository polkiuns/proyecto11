<?php

use Illuminate\Database\Seeder;
use App\Teacher;
use App\User;
use Spatie\Permission\Models\Role;
class TeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        Teacher::Truncate();
        $teacherRole = Role::create(["name" => "teacher"]);


        for ($i = 0; $i < 20; $i++){
        
        $user = new User;

        $teacher = new Teacher;
        $teacher->name = "Profesor ". $i;
        $teacher->surnames = "Apellidos profesor" . $i;
        $teacher->phone = "123456789";
        $teacher->email = "profesor".$i."@gmail.com";
        $teacher->address = "Calle del profesor". $i;
        $teacher->dni = "123456789A";
        
        $user->name = $teacher->name;
        $user->email = $teacher->email;
        $user->password = bcrypt("123");
        $user->save();

        $user->assignRole($teacherRole);

        $teacher->user_id = $user->id;
        $teacher->save();
        for($z = 0; $z<5; $z++){
                  $teacher->subjects()->attach(rand(1 , 24));     
        }
 
        }





    }
}
