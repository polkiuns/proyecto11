<?php

use Illuminate\Database\Seeder;
use App\Subject;
class SubjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Subject::Truncate();
        $z = 0;
        for($i = 3; $i<7 ; $i++){
            $z++;
                $subject = new Subject;
                $subject->name = "Matematicas_".$z."ESO";
                $subject->description = "

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi accumsan, turpis non fringilla mattis, purus mauris dignissim est, nec mollis mi dui eu eros. Suspendisse augue enim, efficitur et nibh ut, congue convallis eros. Vivamus at sollicitudin ante, ac dignissim lectus. Donec nec felis mollis, auctor urna id, tincidunt tellus. Vivamus quis cursus lectus. Nullam consectetur libero leo, sed aliquet felis varius aliquet. Etiam ipsum ante, sollicitudin a leo et, tristique blandit metus. Nam vestibulum pulvinar nulla quis auctor.

Nulla porttitor aliquet augue, sit amet interdum eros elementum in. Nullam pulvinar malesuada elit. Donec erat odio, rhoncus id elementum vitae, aliquam sit amet erat. Sed vitae libero ligula. Cras commodo mollis euismod. Donec sed risus laoreet neque egestas cursus. Vestibulum consequat lorem nunc, at facilisis nibh rutrum sit amet. Proin ultricies ac leo at elementum. Mauris pellentesque lectus ac lorem faucibus consequat. Maecenas egestas maximus risus, at facilisis erat cursus sed. Sed tristique justo at lobortis viverra. Nulla aliquam diam mi, a interdum dui cursus et. In quam tortor, ultricies vel interdum quis, maximus quis purus. Morbi turpis turpis, dictum ac facilisis sit amet, rhoncus at justo. Curabitur sit amet eleifend nulla. Pellentesque id turpis fringilla, pretium ex ut, ullamcorper lacus. " ;
                $subject->save();
                $subject->courses()->attach($i);

                $subject = new Subject;
                $subject->name = "Lengua_".$z."ESO";
                                $subject->description = "

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi accumsan, turpis non fringilla mattis, purus mauris dignissim est, nec mollis mi dui eu eros. Suspendisse augue enim, efficitur et nibh ut, congue convallis eros. Vivamus at sollicitudin ante, ac dignissim lectus. Donec nec felis mollis, auctor urna id, tincidunt tellus. Vivamus quis cursus lectus. Nullam consectetur libero leo, sed aliquet felis varius aliquet. Etiam ipsum ante, sollicitudin a leo et, tristique blandit metus. Nam vestibulum pulvinar nulla quis auctor.

Nulla porttitor aliquet augue, sit amet interdum eros elementum in. Nullam pulvinar malesuada elit. Donec erat odio, rhoncus id elementum vitae, aliquam sit amet erat. Sed vitae libero ligula. Cras commodo mollis euismod. Donec sed risus laoreet neque egestas cursus. Vestibulum consequat lorem nunc, at facilisis nibh rutrum sit amet. Proin ultricies ac leo at elementum. Mauris pellentesque lectus ac lorem faucibus consequat. Maecenas egestas maximus risus, at facilisis erat cursus sed. Sed tristique justo at lobortis viverra. Nulla aliquam diam mi, a interdum dui cursus et. In quam tortor, ultricies vel interdum quis, maximus quis purus. Morbi turpis turpis, dictum ac facilisis sit amet, rhoncus at justo. Curabitur sit amet eleifend nulla. Pellentesque id turpis fringilla, pretium ex ut, ullamcorper lacus. " ;
                $subject->save();
                $subject->courses()->attach($i);    

                $subject = new Subject;
                $subject->name = "Biologia_".$z."ESO";
                                $subject->description = "

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi accumsan, turpis non fringilla mattis, purus mauris dignissim est, nec mollis mi dui eu eros. Suspendisse augue enim, efficitur et nibh ut, congue convallis eros. Vivamus at sollicitudin ante, ac dignissim lectus. Donec nec felis mollis, auctor urna id, tincidunt tellus. Vivamus quis cursus lectus. Nullam consectetur libero leo, sed aliquet felis varius aliquet. Etiam ipsum ante, sollicitudin a leo et, tristique blandit metus. Nam vestibulum pulvinar nulla quis auctor.

Nulla porttitor aliquet augue, sit amet interdum eros elementum in. Nullam pulvinar malesuada elit. Donec erat odio, rhoncus id elementum vitae, aliquam sit amet erat. Sed vitae libero ligula. Cras commodo mollis euismod. Donec sed risus laoreet neque egestas cursus. Vestibulum consequat lorem nunc, at facilisis nibh rutrum sit amet. Proin ultricies ac leo at elementum. Mauris pellentesque lectus ac lorem faucibus consequat. Maecenas egestas maximus risus, at facilisis erat cursus sed. Sed tristique justo at lobortis viverra. Nulla aliquam diam mi, a interdum dui cursus et. In quam tortor, ultricies vel interdum quis, maximus quis purus. Morbi turpis turpis, dictum ac facilisis sit amet, rhoncus at justo. Curabitur sit amet eleifend nulla. Pellentesque id turpis fringilla, pretium ex ut, ullamcorper lacus. " ;
                $subject->save();
                $subject->courses()->attach($i);    

                $subject = new Subject;
                $subject->name = "Fisica_".$z."ESO";
                                $subject->description = "

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi accumsan, turpis non fringilla mattis, purus mauris dignissim est, nec mollis mi dui eu eros. Suspendisse augue enim, efficitur et nibh ut, congue convallis eros. Vivamus at sollicitudin ante, ac dignissim lectus. Donec nec felis mollis, auctor urna id, tincidunt tellus. Vivamus quis cursus lectus. Nullam consectetur libero leo, sed aliquet felis varius aliquet. Etiam ipsum ante, sollicitudin a leo et, tristique blandit metus. Nam vestibulum pulvinar nulla quis auctor.

Nulla porttitor aliquet augue, sit amet interdum eros elementum in. Nullam pulvinar malesuada elit. Donec erat odio, rhoncus id elementum vitae, aliquam sit amet erat. Sed vitae libero ligula. Cras commodo mollis euismod. Donec sed risus laoreet neque egestas cursus. Vestibulum consequat lorem nunc, at facilisis nibh rutrum sit amet. Proin ultricies ac leo at elementum. Mauris pellentesque lectus ac lorem faucibus consequat. Maecenas egestas maximus risus, at facilisis erat cursus sed. Sed tristique justo at lobortis viverra. Nulla aliquam diam mi, a interdum dui cursus et. In quam tortor, ultricies vel interdum quis, maximus quis purus. Morbi turpis turpis, dictum ac facilisis sit amet, rhoncus at justo. Curabitur sit amet eleifend nulla. Pellentesque id turpis fringilla, pretium ex ut, ullamcorper lacus. " ;
                $subject->save();
                $subject->courses()->attach($i);    

                $subject = new Subject;
                $subject->name = "Quimica_".$z."ESO";
                                $subject->description = "

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi accumsan, turpis non fringilla mattis, purus mauris dignissim est, nec mollis mi dui eu eros. Suspendisse augue enim, efficitur et nibh ut, congue convallis eros. Vivamus at sollicitudin ante, ac dignissim lectus. Donec nec felis mollis, auctor urna id, tincidunt tellus. Vivamus quis cursus lectus. Nullam consectetur libero leo, sed aliquet felis varius aliquet. Etiam ipsum ante, sollicitudin a leo et, tristique blandit metus. Nam vestibulum pulvinar nulla quis auctor.

Nulla porttitor aliquet augue, sit amet interdum eros elementum in. Nullam pulvinar malesuada elit. Donec erat odio, rhoncus id elementum vitae, aliquam sit amet erat. Sed vitae libero ligula. Cras commodo mollis euismod. Donec sed risus laoreet neque egestas cursus. Vestibulum consequat lorem nunc, at facilisis nibh rutrum sit amet. Proin ultricies ac leo at elementum. Mauris pellentesque lectus ac lorem faucibus consequat. Maecenas egestas maximus risus, at facilisis erat cursus sed. Sed tristique justo at lobortis viverra. Nulla aliquam diam mi, a interdum dui cursus et. In quam tortor, ultricies vel interdum quis, maximus quis purus. Morbi turpis turpis, dictum ac facilisis sit amet, rhoncus at justo. Curabitur sit amet eleifend nulla. Pellentesque id turpis fringilla, pretium ex ut, ullamcorper lacus. " ;
                $subject->save();
                $subject->courses()->attach($i);    

                $subject = new Subject;
                $subject->name = "Ingles_".$z."ESO";
                                $subject->description = "

Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi accumsan, turpis non fringilla mattis, purus mauris dignissim est, nec mollis mi dui eu eros. Suspendisse augue enim, efficitur et nibh ut, congue convallis eros. Vivamus at sollicitudin ante, ac dignissim lectus. Donec nec felis mollis, auctor urna id, tincidunt tellus. Vivamus quis cursus lectus. Nullam consectetur libero leo, sed aliquet felis varius aliquet. Etiam ipsum ante, sollicitudin a leo et, tristique blandit metus. Nam vestibulum pulvinar nulla quis auctor.

Nulla porttitor aliquet augue, sit amet interdum eros elementum in. Nullam pulvinar malesuada elit. Donec erat odio, rhoncus id elementum vitae, aliquam sit amet erat. Sed vitae libero ligula. Cras commodo mollis euismod. Donec sed risus laoreet neque egestas cursus. Vestibulum consequat lorem nunc, at facilisis nibh rutrum sit amet. Proin ultricies ac leo at elementum. Mauris pellentesque lectus ac lorem faucibus consequat. Maecenas egestas maximus risus, at facilisis erat cursus sed. Sed tristique justo at lobortis viverra. Nulla aliquam diam mi, a interdum dui cursus et. In quam tortor, ultricies vel interdum quis, maximus quis purus. Morbi turpis turpis, dictum ac facilisis sit amet, rhoncus at justo. Curabitur sit amet eleifend nulla. Pellentesque id turpis fringilla, pretium ex ut, ullamcorper lacus. " ;
                $subject->save();
                $subject->courses()->attach($i);                             
            
    }
}
}