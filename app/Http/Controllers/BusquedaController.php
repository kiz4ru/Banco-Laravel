<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cliente;
use App\Models\Cuenta;

class BusquedaController extends Controller
{
    public function buscar(Request $request)
    {
        $tipoBusqueda = $request->input('tipo');
        $busqueda = $request->input('valor');

        switch ($tipoBusqueda) {
            case 'cliente':
                $cliente = Cliente::whereLike('dni', $busqueda)->get();

                if (!$cliente) 
                    return redirect('/administracion')->with('error', 'No se ha encontrado el cliente');

                return view('admin.consultas.clientes', ['clientes' => $cliente]);
                break;
            case 'cuenta':
                $cuenta = Cuenta::whereLike('id', $busqueda)->get();

                if (!$cuenta)
                    return redirect('/administracion')->with('error', 'No se ha encontrado la cuenta');

                return view('admin.consultas.cuentas', ['cuentas' => $cuenta, 'clientes' => Cliente::all()]);
                break;
            case 'saldo':
                $cuentas = Cuenta::whereLike('balance', $busqueda)->get();

                if ($cuentas->count() > 0)
                    return view('admin.consultas.cuentas', ['cuentas' => $cuentas, 'clientes' => Cliente::all()]);

                break;
            default:
                return redirect('/administracion')->with('error', 'El tipo de búsqueda es erróneo');
                break;
        }

        return redirect('/administracion')->with('error', 'No se han encontrado datos con los parámetros indicados');
    }
}
