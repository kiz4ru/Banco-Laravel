<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Transferencia;
use App\Models\Cuenta;

class TransferenciaController extends Controller
{
    public static function crearTransferencia(Request $request)
    {
        $request->validate(
            [
                'cuenta_origen' => 'required|exists:cuentas,id',
                'cuenta_destino' => 'required|exists:cuentas,id',
                'cantidad' => 'required|numeric',
            ],
            [
                'cuenta_origen.required' => 'La cuenta de origen es obligatoria',
                'cuenta_origen.integer' => 'La cuenta de origen debe ser un número entero',
                'cuenta_origen.exists' => 'La cuenta de origen no existe',
                'cuenta_destino.required' => 'La cuenta de destino es obligatoria',
                'cuenta_destino.integer' => 'La cuenta de destino debe ser un número entero',
                'cuenta_destino.exists' => 'La cuenta de destino no existe',
                'cantidad.required' => 'La cantidad es obligatoria',
                'cantidad.numeric' => 'La cantidad debe ser un número',
            ]
        );


        $cuenta_origen = Cuenta::find($request->cuenta_origen);
        $cuenta_destino = Cuenta::find($request->cuenta_destino);

        if ($request->cuenta_origen == $request->cuenta_destino)
            return redirect('/registertransferencias')->with('error', 'La cuenta de origen y la cuenta de destino no pueden ser la misma');

        if ($cuenta_origen->balance < $request->cantidad)
            return redirect('/registertransferencias')->with('error', 'La cuenta de origen no tiene suficiente saldo para realizar la transferencia');

        if ($cuenta_origen->id_cliente != session('cliente')->id)
            return redirect('/registertransferencias')->with('error', 'La cuenta de origen no pertenece al cliente logueado');

        $transferencia = new Transferencia();
        $transferencia->cuenta_origen = $request->cuenta_origen;
        $transferencia->cuenta_destino = $request->cuenta_destino;
        $transferencia->cantidad = $request->cantidad;
        $transferencia = $transferencia->save();

        if ($transferencia) {
            $cuenta_origen->balance -= $request->cantidad;
            $cuenta_destino->balance += $request->cantidad;
            $cuenta_origen->save();
            $cuenta_destino->save();

            return redirect('/registertransferencias')->with('success', 'Transferencia realizada con éxito');
        }

        return redirect('/registertransferencias')->with('error', 'Error al realizar la transferencia');
    }
}
