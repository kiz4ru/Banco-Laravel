@include('main.includes.head')

<body>
    @include('main.includes.navbar')
    @session('success')
        <div class="alert alert-success mt-5">{{ $value }}</div>
    @endsession

    @session('error')
        <div class="alert alert-danger mt-5">{{ $value }}</div>
    @endsession

    @php
        $cuentasCliente = $cuentas->where('id_cliente', session('cliente')->id);
    @endphp

    <div class="mt-3 mb-3 text-center vh-100">
        <h1>Cuentas</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Numero de cuenta</th>
                    <th>Balance</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {{-- Dibujar cuentas que pertenecen al administrador primero --}}
                @foreach ($cuentasCliente as $cuenta)
                    <tr class="table-warning">
                        <td>{{ $cuenta->id }}</td>
                        <td>{{ number_format($cuenta->balance, 2) }}&euro;</td>
                        <td>
                            <a href="/cuentasusuario/{{ $cuenta->id }}" class="btn btn-primary">Ver</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('main.includes.footer')
</body>
