<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', 'StaticPagesController@index')->name('index');
Route::get('contact', 'StaticPagesController@contact')->name('contact');
Route::get('cursos' , 'CoursesController@index')->name('courses');
Route::get('curso/{course?}/{subject?}' , 'SubjectsController@index')->name('subjects.index');
Route::get('asignatura/{subject}/{clase}' , 'ClasesController@index')->name('classes.index')->middleware('auth');

//Rutas para suscripciones
Route::post('asignatura/{subject}' , 'SubcriptionsController@create')->name('subcription.create');

//Rutas para comentarios clase
Route::post('comentario/{clase}' , 'CommentsController@create')->name('classes.comments');
Route::put('comentario/{comment}' , 'CommentsController@edit')->name('classes.comments.edit');
Route::delete('comentario/{comment}' , 'CommentsController@delete')->name('classes.comments.delete');

//Rutas para descarga de archivo
Route::get('download/{file}', 'FilesController@download')->name('clase.file.download');

//Rutas para entregas
Route::post('upload/file/{clase}' , 'DeliveriesController@upload');
Route::delete('delete/file/{clase}' , 'DeliveriesController@delete')->name('deliveries.delete');
Route::get('download/delivery/{clase}' , 'DeliveriesController@download')->name('deliveries.download');




Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function() {

	Route::get('/', 'AdminController@index')->name('admin');




	//Rutas para los cursos
	Route::get('cursos' , 'CoursesController@index')->name('admin.courses');
	Route::get('crear/curso' , 'CoursesController@create')->name('admin.courses.create');
	Route::post('cursos' , 'CoursesController@store')->name('admin.courses.store');
	Route::get('editar/curso/{course}' , 'CoursesController@edit')->name('admin.courses.edit');
	Route::put('cursos/{course}' , 'CoursesController@update')->name('admin.courses.update');
	Route::delete('cursos/{course}' , 'CoursesController@delete')->name('admin.courses.delete');

	//Rutas para las asignaturas
	Route::get('asignaturas' , 'SubjectsController@index')->name('admin.subjects');
	Route::get('crear/asignatura' , 'SubjectsController@create')->name('admin.subjects.create');
	Route::post('asignaturas' , 'SubjectsController@store')->name('admin.subjects.store');
	Route::get('editar/asignatura/{subject}' , 'SubjectsController@edit')->name('admin.subjects.edit');
	Route::put('asignaturas/{subject}' , 'SubjectsController@update')->name('admin.subjects.update');
	Route::delete('asignaturas/{subject}' , 'SubjectsController@delete')->name('admin.subjects.delete');

	//Rutas para las lecciones
	Route::get('lecciones' , 'LessonsController@index')->name('admin.lessons');
	Route::get('crear/leccion' , 'LessonsController@create')->name('admin.lessons.create');
	Route::post('lecciones' , 'LessonsController@store')->name('admin.lessons.store');
	Route::get('editar/leccion/{lesson}' , 'LessonsController@edit')->name('admin.lessons.edit');
	Route::put('lecciones/{lesson}' , 'LessonsController@update')->name('admin.lessons.update');
	Route::delete('lecciones/{lesson}' , 'LessonsController@delete')->name('admin.lessons.delete');

	Route::get('getLesson/{id}' , 'DynamicSelectsController@lesson');

	//Rutas para las clases
	Route::get('clases' , 'ClasesController@index')->name('admin.classes');
	Route::get('crear/clase' , 'ClasesController@create')->name('admin.classes.create');
	Route::post('clases' , 'ClasesController@store')->name('admin.classes.store');
	Route::get('editar/clase/{class}' , 'ClasesController@edit')->name('admin.classes.edit');
	Route::put('clases/{class}' , 'ClasesController@update')->name('admin.classes.update');
	Route::delete('clases/{class}' , 'ClasesController@delete')->name('admin.classes.delete');
	Route::get('clase/entregas/{clase}' , 'ClasesController@show')->name('admin.classes.deliveries');

	//Rutas para los profesores
	Route::get('profesores' , 'TeachersController@index')->name('admin.teachers');
	Route::get('registrar/profesor' , 'TeachersController@create')->name('admin.teachers.create');
	Route::post('profesores' , 'TeachersController@store')->name('admin.teachers.store');
	Route::get('editar/profesor/{teacher}' , 'TeachersController@edit')->name('admin.teachers.edit');
	Route::put('profesores/{teacher}' , 'TeachersController@update')->name('admin.teachers.update');
	Route::delete('profesores/{teacher}' , 'TeachersController@delete')->name('admin.teachers.delete');

	//Rutas para los alumnos
	Route::get('alumnos' , 'StudentsController@index')->name('admin.students');
	Route::get('registrar/alumnos' , 'StudentsController@create')->name('admin.students.create');
	Route::post('alumnos' , 'StudentsController@store')->name('admin.students.store');
	Route::get('editar/alumnos/{student}' , 'StudentsController@edit')->name('admin.students.edit');
	Route::put('alumnos/{student}' , 'StudentsController@update')->name('admin.students.update');
	Route::delete('alumnos/{student}' , 'StudentsController@delete')->name('admin.students.delete');

	//Rutas para subcripciones

	Route::get('subcripciones' , 'SubcriptionsController@index')->name('admin.subcriptions');
	Route::get('subcripciones/aceptar/{subcription}' , 'SubcriptionsController@accept')->name('admin.subcription.accept');
	Route::get('subcripciones/denegar/{subcription}' , 'SubcriptionsController@denegate')->name('admin.subcription.denegate');

	//Rutas para archivos
	Route::post('file/{idClase}' , 'FilesController@store')->name('admin.file.create');
	Route::post('file/edit/{idClase}' , 'FilesController@update')->name('admin.file.update');
	Route::delete('file/{file}' , 'FilesController@delete')->name('admin.file.delete');
	Route::get('file/{file}' , 'FilesController@download')->name('admin.file.download');

	//Rutas para entregas
	Route::get('download/delivery/{delivery}' , 'DeliveriesController@download')->name('admin.deliveries.download');
	Route::put('delivery/{delivery}' , 'DeliveriesController@edit')->name('admin.deliveries.grades');
	Route::delete('delivery/{delivery}' , 'DeliveriesController@delete')->name('admin.deliveries.delete');

});



Auth::routes();


