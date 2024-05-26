<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Models\Cliente;
use Illuminate\Support\Facades\Hash;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {
            $client = new Cliente();
            $client->dni = $faker->unique()->randomNumber(9, true);
            $client->mail = $faker->email;
            $client->nombre = $faker->firstName;
            $client->apellidos = $faker->lastName.' '.$faker->lastName;
            $client->clave_banco = Hash::make('321321');
            $client->es_admin = $faker->boolean();
            $client->save();
        }
    }
}
