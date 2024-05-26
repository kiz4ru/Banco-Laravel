<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Hash;

use App\Models\Cliente;
use App\Models\Cuenta;

class ClienteController extends Controller
{
    public static function login(Request $request)
    {
        $request->validate([
            'dni' => 'required|min:9|max:9',
            'clave' => 'required|min:6|max:6'
        ],
        [
            'dni.required' => 'El DNI es obligatorio',
            'dni.min' => 'El DNI debe tener 9 caracteres',
            'dni.max' => 'El DNI debe tener 9 caracteres',
            'clave.required' => 'La clave es obligatoria',
            'clave.min' => 'La clave debe tener 6 caracteres',
            'clave.max' => 'La clave debe tener 6 caracteres'
        ]
        );

        $cliente = Cliente::where('DNI', $request->dni)->first();

        if($cliente)
        {
            if(Hash::check($request->clave, $cliente->clave_banco))
            {
                $request->session()->put('cliente', $cliente);
                if($cliente->es_admin)
                {
                    return redirect('/administracion');
                }
                else
                {
                    return redirect('/inicio');
                }
            }
            else
            {
                return redirect('/login')->with('error', '¡Clave incorrecta!');
            }
        }
        else
        {
            return redirect('/login')->with('error', '¡Este DNI no está registrado!');
        }
    }

    public static function registrarUsuario(Request $request)
    {
        $request->validate([
            'dni' => 'required|min:9|max:9|unique:clientes,DNI',
            'nombre' => 'required|min:3|max:15',
            'apellidos' => 'required|min:3|max:50',
            'mail' => 'required|email|unique:clientes,mail',
            'clave' => 'required|min:6|max:6'
        ],
        [
            'dni.required' => 'El DNI es obligatorio',
            'dni.min' => 'El DNI debe tener 9 caracteres',
            'dni.max' => 'El DNI debe tener 9 caracteres',
            'dni.unique' => 'El DNI ya está registrado',
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres',
            'nombre.max' => 'El nombre no puede tener más de 15 caracteres',
            'apellidos.required' => 'Los apellidos son obligatorios',
            'apellidos.min' => 'Los apellidos deben tener al menos 3 caracteres',
            'apellidos.max' => 'Los apellidos no pueden tener más de 50 caracteres',
            'mail.required' => 'El correo es obligatorio',
            'mail.email' => 'El correo no es válido',
            'mail.unique' => 'El correo ya está registrado',
            'clave.required' => 'La clave es obligatoria',
            'clave.min' => 'La clave debe tener 6 caracteres',
            'clave.max' => 'La clave debe tener 6 caracteres'
        ]
        );

        $cliente = new Cliente();
        $cliente->DNI = $request->dni;
        $cliente->nombre = $request->nombre;
        $cliente->apellidos = $request->apellidos;
        $cliente->mail = $request->mail;
        $cliente->clave_banco = Hash::make($request->clave);
        $cliente->es_admin = $request->admin ?? false;

        $registrado = $cliente->save();

        if($registrado)
        {
            return view('main.login.register', ['success' => 1]);
        }
        else
        {
            return view('main.login.register', ['errorServidor' => 1]);
        }
    }

    public static function eliminarUsuario(string $id)
    {
        $cliente = Cliente::find($id);

        if(!$cliente)
        {
            return redirect('/clientes')->with('error', 'El usuario no existe');
        }

        $eliminado = $cliente->delete();

        if(session('cliente')->id == $id)
        {
           return redirect('/logout');
        }

        if($eliminado)
        {
            return redirect('/clientes')->with('success', 'Usuario eliminado correctamente');
        }
        else
        {
            return redirect('/clientes')->with('error', 'Error al eliminar el usuario');
        }
    }

    public static function consultarCliente(string $id)
    {
        $cliente = Cliente::where('dni', $id)->first();

        if(!$cliente)
        {
            return redirect('/clientes')->with('error', 'El usuario no existe');
        }

        return view('admin.consultas.especificas.cliente', ['cliente' => $cliente]);

    }
}
