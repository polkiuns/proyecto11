<?php

use Illuminate\Database\Seeder;
use App\Clase;
use App\controlClase;

class ClasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    		$class = new Clase;
            $class->name = "Clase numero 1";
            $class->url = str_slug($class->name);
            $class->description = "Descripcion clase 1";
            $class->body = "Cuerpo clase 1";
            $class->iframe = "Iframe de ejemplo";
            $class->lesson_id = 1;
            $class->published = true;
            $class->save();

            $control = new controlClase;
            $control->save();
    }
}
