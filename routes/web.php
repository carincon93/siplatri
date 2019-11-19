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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

// Deshabilitar la ruta de registro
Route::match(['get', 'post'], 'register', function(){
    return redirect('/');
});

// Route::get('/programaciones/busqueda', 'ProgramacionController@busqueda')->name('programaciones.busqueda');
Route::get('/users/excel/{id}', 'UserController@exportar')->name('users.exportar');
Route::get('/ambientes/excel/{id}', 'AmbienteController@exportar')->name('ambientes.exportar');
Route::get('/programas_formacion/excel/{id}', 'ProgramaFormacionController@exportar')->name('programas_formacion.exportar');
Route::get('/programaciones/excel/{id}', 'ProgramacionController@exportar')->name('programaciones.exportar');

Route::put('/horarios/{ProgramacionId}/modificar', 'HorarioController@update')->name('horarios.update');
Route::delete('/horarios/eliminar', 'HorarioController@destroy')->name('horarios.destroy');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/filtros', 'HomeController@filtros')->name('filtros');
Route::get('/ambientes/ver-programacion-ambiente', 'AmbienteController@obtenerHorarioProgramado')->name('ambientes.obtenerHorarioProgramado');
Route::get('/users/ver-programacion-instructor', 'UserController@obtenerHorarioProgramado')->name('users.obtenerHorarioProgramado');
Route::get('/resultados_aprendizaje/obtener_resultados', 'ResultadoAprendizajeController@obtenerResultados');
Route::get('/obtener_horas_competencia/{id}', 'CompetenciaController@obtenerHoras');
Route::post('/horarios/guardar', 'HorarioController@store');
Route::post('/programaciones/{ProgramacionId}/agregar/horario', 'HorarioController@store');
Route::post('/programaciones/{ProgramacionId}/en_espera/horario', 'HorarioController@programacionEnEspera');
Route::get('/programaciones/obtener_horarios', 'HorarioController@obtenerHorario');
Route::get('/programaciones/obtener_ambientes', 'AmbienteController@obtenerAmbientesDisponibles');
Route::get('/programaciones/obtener_instructores', 'UserController@obtenerInstructoresDisponibles');
Route::get('/programaciones/obtener_asignaciones', 'HorarioController@obtenerAsignaciones');
Route::get('/programaciones/obtener_horas_acumuladas', 'UserController@obtenerHorasAcumuladas');
Route::get('/horarios/crear/{id}', 'HorarioController@create')->name('horarios.create');
Route::get('/trimestres/obtener_trimestres', 'TrimestreController@obtenerTrimestres');
Route::put('/trimestres/programar/{id}', 'TrimestreController@activarProgramacion')->name('trimestres.programar');
Route::put('/trimestres/activar/{id}', 'TrimestreController@activarTrimestre')->name('trimestres.activar');
// Route::get('/cambiar_trimestre', 'TrimestreController@formularioTrimestre')->name('trimestres.formularioTrimestre');
// Route::post('/cambiar_trimestre', 'TrimestreController@crearCambiarTrimestre')->name('trimestres.crearCambiarTrimestre');
// Route::get('/trimestres', 'TrimestreController@index')->name('trimestres.index');

// Route::get('/users/{id}/pdf', 'UserController@programacionPdf')->name('users.programacionPdf');
// Route::get('/programaciones/{id}/pdf', 'ProgramacionController@pdf')->name('programaciones.pdf');
// Route::get('/ambientes/{id}/pdf', 'AmbienteController@programacionPdf')->name('ambientes.programacionPdf');

Route::resource('trimestres', 'TrimestreController');
Route::resource('programas_formacion', 'ProgramaFormacionController');
Route::resource('programaciones', 'ProgramacionController');
Route::resource('competencias', 'CompetenciaController');
Route::resource('resultados_aprendizaje', 'ResultadoAprendizajeController');
Route::resource('municipios', 'MunicipioController');
Route::resource('users', 'UserController');
Route::resource('ambientes', 'AmbienteController');
Route::resource('franjas', 'FranjaController');
Route::resource('actividades', 'OtraActividadController');
