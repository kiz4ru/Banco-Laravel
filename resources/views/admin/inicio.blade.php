@include('main.includes.head')

<body>
    @include('main.includes.navbar')

    @session('error')
        <div class="alert alert-danger mt-5">{{ $value }}</div>
    @endsession


    <div class="d-flex justify-content-center align-items-center mb-5 mt-5 vh-100">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h2 class="card-title">Consultar clientes</h2>
                            <p class="card-text">Pulsa aquí para consultar/editar clientes</p>
                            <a href="/clientes" class="btn btn-primary w-100">Ir</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h2 class="card-title">Consultar cuentas</h2>
                            <p class="card-text">Pulsa aquí para consultar/editar cuentas</p>
                            <a href="/cuentas" class="btn btn-primary w-100">Ir</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h2 class="card-title">Consultar transferencias</h2>
                            <p class="card-text">Pulsa aquí para consultar transferencias</p>
                            <a href="/transferencias" class="btn btn-primary w-100">Ir</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h2 class="card-title">Registrar clientes</h2>
                            <p class="card-text">Pulsa aquí para crear clientes</p>
                            <a href="/register" class="btn btn-primary w-100">Ir</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h2 class="card-title">Registrar cuentas</h2>
                            <p class="card-text">Pulsa aquí para crear cuentas</p>
                            <a href="/registercuentas" class="btn btn-primary w-100">Ir</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body text-center">
                            <h2 class="card-title">Crear transferencia</h2>
                            <p class="card-text">Pulsa aquí para crear transferencias</p>
                            <a href="/registertransferencias" class="btn btn-primary w-100">Ir</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="flex-col">
                    <div class="card">
                        <div class="card-body text-center">
                            <h2 class="card-title">Búsqueda por valores</h2>
                            <p class="card-text">Introduce aquí los datos para la búsqueda</p>
                            <form action="/busqueda" method="POST">
                                @csrf
                                <div class="form-group">
                                    <div class="d-flex flex-column mb-3">
                                        <div class="d-inline-flex">
                                            <input type="text" name="valor" id="valor" class="form-control">
                                            <select name="tipo" class="form-select w-25">
                                                <option value="cliente" selected>Cliente</option>
                                                <option value="cuenta">Cuenta</option>
                                                <option value="saldo">Saldo</option>
                                            </select>
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-primary">Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @include('main.includes.footer')
</body>
