<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

//Agregar Controllers
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CuentaController;
use App\Http\Controllers\BusquedaController;
use App\Http\Controllers\TransferenciaController;

//Agregar Middlewares
use App\Http\Middleware\CheckCliente; //Comprobar si está logueado
use App\Http\Middleware\CheckClienteAdmin; //Comprobar si es administrador

//Agregar Models
use App\Models\Cliente;
use App\Models\Cuenta;
use App\Models\Transferencia;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/infodb', function () {
    return response()->json([Cliente::all(), Cuenta::all()]);
});

//Views y método autenticación
Route::get('/login', function () {
    return view('main.login.login');
});

Route::post('/login', [ClienteController::class, 'login']);

//Middleware para comprobar si el usuario tiene la sesión iniciada.
Route::middleware([CheckCliente::class])->group(function () {

    //Views y métodos de usuario
    Route::get('/logout', function () {
        Session::flush();
        return redirect('/');
    });
    
    //Página principal usuario
    Route::get('/inicio', function () {
        return view('usuario.inicio');
    });

    //Consulta de cuentas
    Route::get('/cuentasusuario', function () {
        return view('usuario.consultas.cuentas', ['cuentas' => Cuenta::where('id_cliente', Session::get('cliente')->id)->get()]);
    });

    //Consulta de cuenta específica
    Route::get('/cuentasusuario/{id}', [CuentaController::class, 'consultarCuentaUsuario']);

    //Crear transferencia
    Route::get('/registertransferencias', function () {
        return view('usuario.menus.creartransferencia', ['cuentas_cliente' => Cuenta::where('id_cliente', Session::get('cliente')->id)->get()]);
    });

    Route::post('/registertransferencias', [TransferenciaController::class, 'crearTransferencia']);

    //Views y métodos de administradores
    Route::middleware([CheckClienteAdmin::class])->group(function () {

        //Página principal administrador
        Route::get('/administracion', function () {
            return view('admin.inicio');
        });

        //Views y método de consultas
            
                //Consulta usuarios
                Route::get('/clientes', function () {
                    return view('admin.consultas.clientes', ['clientes' => Cliente::all()]);
                });

                //Consulta cliente específico
                Route::get('/clientes/{id}', [ClienteController::class, 'consultarCliente']);
    
                //Consulta cuentas
                Route::get('/cuentas', function () {
                    return view('admin.consultas.cuentas', ['cuentas' => Cuenta::all(), 'clientes' => Cliente::all()]);
                });

                //Consulta cuenta específica
                Route::get('/cuentas/{id}', [CuentaController::class, 'consultarCuenta']);

                //Consulta transferencias
                Route::get('/transferencias', function () {
                    return view('admin.consultas.transferencias', ['transferencias' => Transferencia::all(), 'cuentas' => Cuenta::all()]);
                });

                //Consulta por búsqueda
                Route::post('/busqueda', [BusquedaController::class, 'buscar']);


        //Views y métodos creación

            //Registro usuarios
            Route::get('/register', function () {
                return view('admin.menus.register');
            });

            Route::post('/register', [ClienteController::class, 'registrarUsuario']);

            //Registro cuentas
            Route::get('/registercuentas', function () {
                return view('admin.menus.registercuentas', ['clientes' => Cliente::all()]);
            });

            Route::post('/registercuentas', [CuentaController::class, 'registrarCuenta']);

        //Views y métodos eliminación
            
                //Eliminar usuarios
                Route::get('/clientes/deletecliente/{id}', function (string $id) {
                    return ClienteController::eliminarUsuario($id);
                });
    
                Route::get('/cuentas/deletecuenta/{id}', function (string $id) {
                    return CuentaController::eliminarCuenta($id);
                });
    });
});


