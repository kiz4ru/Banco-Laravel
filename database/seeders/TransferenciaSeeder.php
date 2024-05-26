<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Models\Cuenta;
use App\Models\Transferencia;

class TransferenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            $transferencia = new Transferencia();
            $transferencia->cuenta_origen = Cuenta::all()->random()->id;
            $transferencia->cuenta_destino = Cuenta::all()->random()->id;
            $transferencia->cantidad = $faker->randomFloat(2, 0, 10000);
            $transferencia->save();
        }
    }
}
