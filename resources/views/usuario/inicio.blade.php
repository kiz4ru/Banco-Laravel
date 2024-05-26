@include('main.includes.head')

<body>
    @include('main.includes.navbar')

    <div class="d-flex justify-content-center align-items-center mb-5 mt-5 vh-100">
        <div class="container">
            <div class="row mb-5">
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center">
                            <h2 class="card-title">Consultar cuentas</h2>
                            <p class="card-text">Pulsa aquí para consultar tus cuentas</p>
                            <a href="/cuentasusuario" class="btn btn-primary w-100">Ir</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center">
                            <h2 class="card-title">Crear transferencia</h2>
                            <p class="card-text">Pulsa aquí para crear transferencias</p>
                            <a href="/registertransferencias" class="btn btn-primary w-100">Ir</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('main.includes.footer')
</body>
