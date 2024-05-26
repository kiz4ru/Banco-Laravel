<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cuenta;
use App\Models\Cliente;

class CuentaController extends Controller
{
    public function registrarCuenta(Request $request)
    {
        $request->validate(
            [
                'dni' => 'required|min:9|max:9',
                'balance' => 'required'
            ],
            [
                'dni.required' => 'El campo DNI es obligatorio',
                'dni.min' => 'El DNI debe tener 9 caracteres',
                'dni.max' => 'El DNI debe tener 9 caracteres',
                'balance.required' => '¡Tienes que introducir un balance!'
            ]
        );

        if (!Cliente::where('dni', $request->dni)->exists())
            return view('admin.menus.registercuentas')->with('error', '¡El cliente no existe!');

        $cliente = Cliente::where('dni', $request->dni)->first();

        $cuenta = new Cuenta();
        $cuenta->id_cliente = $cliente->id;
        $cuenta->balance = $request->balance;
        $registrada = $cuenta->save();

        if ($registrada)
            return view('admin.menus.registercuentas')->with('success', '¡Cuenta registrada correctamente!');
        else
            return view('admin.menus.registercuentas')->with('error', '¡Ha ocurrido un error al registrar la cuenta!');
    }

    public static function consultarCuenta(string $id)
    {
        $cuenta = Cuenta::find($id);

        if ($cuenta == null)
            return redirect('/administracion')->with('error', '¡No se ha encontrado la cuenta!');

        return view('admin.consultas.especificas.cuenta', ['cuenta' => $cuenta]);
    }

    public static function consultarCuentaUsuario(string $id)
    {
        $cuenta = Cuenta::find($id);

        if ($cuenta == null || $cuenta->id_cliente != session('cliente')->id)
            return redirect('/cuentasusuario')->with('error', '¡No se ha encontrado la cuenta!');

        return view('usuario.consultas.especificas.cuenta', ['cuenta' => $cuenta]);
    }

    public static function eliminarCuenta(string $id)
    {
        $cuenta = Cuenta::find($id);

        if ($cuenta == null)
            return redirect('/cuentas')->with('error', '¡No se ha encontrado la cuenta!');

        $eliminada = $cuenta->delete();

        if ($eliminada)
            return redirect('/cuentas')->with('success', '¡Cuenta eliminada correctamente!');
        else
            return redirect('/cuentas')->with('error', '¡Ha ocurrido un error al eliminar la cuenta!');
    }

    public static function buscarCuentaPorSaldo($saldo)
    {
        $cuentas = Cuenta::where('balance', $saldo)->get();

        return $cuentas;
    }
}
