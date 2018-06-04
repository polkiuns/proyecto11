<?php

use Illuminate\Database\Seeder;
use App\Lesson;
use App\Subject;

class LessonsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Lesson::Truncate();
            $z = 0;
            $a = 1;
        for($i = 1; $i<241; $i++){
            $z++;
                $lesson = new Lesson;
                $lesson->name = "Tema " . $z;
                $lesson->subject_id = $a;
                $lesson->teacher_id = $lesson->subject->teachers->pluck('id')->first();
                $lesson->save();
            if($z == 11) {
                $z = 1;
                $a++;
            }          
        }

    }
}
