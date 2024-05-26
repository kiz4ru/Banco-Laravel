<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Models\Cuenta;
use App\Models\Cliente;

class CuentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            $cuenta = new Cuenta();
            $cuenta->id_cliente = Cliente::all()->random()->id;
            $cuenta->balance = $faker->randomFloat(2, 0, 10000);
            $cuenta->save();
        }
    }
}
