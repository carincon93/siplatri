<?php

use Illuminate\Database\Seeder;

use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        User::create([
            'nombre'            => 'Cristian',
            'email'             => 'camilo@mail.com',
            'password'          => bcrypt('admin123'),
            'numeroDocumento'   => '1053',
            'genero'            => 'Masculino',
            'rol'               => 'Admin',
            'tipoContrato'      => 'Planta',
            'estado'            => 'Activo',
            'horasAcumuladas'   => '40',
        ]);
    }
}
