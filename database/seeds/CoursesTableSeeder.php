<?php

use Illuminate\Database\Seeder;
use App\Course;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::Truncate();

        $course = new Course;
        $course->name = "ESO";
        $course->course_id = null;
        $course->save();

        $course = new Course;
        $course->name = "Bachiller";
        $course->course_id = null;
        $course->save();

        $course = new Course;
        $course->name = "1_Eso";
        $course->course_id = 1;
        $course->save();

        $course = new Course;
        $course->name = "2_Eso";
        $course->course_id = 1;
        $course->save();

        $course = new Course;
        $course->name = "3_Eso";
        $course->course_id = 1;
        $course->save();

        $course = new Course;
        $course->name = "4_Eso";
        $course->course_id = 1;
        $course->save();

        $course = new Course;
        $course->name = "1_Bach";
        $course->course_id = 2;
        $course->save();

        $course = new Course;
        $course->name = "2_Bach";
        $course->course_id = 2;
        $course->save();


    }
}
