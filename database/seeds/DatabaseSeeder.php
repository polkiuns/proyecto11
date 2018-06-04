<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        $this->call(UsersTableSeeder::class);
        $this->call(SubjectsTableSeeder::class);
        $this->call(CoursesTableSeeder::class);
        $this->call(TeachersTableSeeder::class);
        $this->call(LessonsTableSeeder::class);
        $this->call(ClasesTableSeeder::class);

        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
    }
}
