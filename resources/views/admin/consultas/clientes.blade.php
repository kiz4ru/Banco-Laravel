@include('main.includes.head')

<body>
    @include('main.includes.navbar')
    @session('success')
        <div class="alert alert-success mt-5">{{ $value }}</div>
    @endsession

    @session('error')
        <div class="alert alert-danger mt-5">{{ $value }}</div>
    @endsession

    <div class="mt-3 mb-3 text-center">
        <h1>Clientes</h1>
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>DNI</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Administrador</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($clientes as $cliente)
                    <tr @if ($cliente->id == session('cliente')->id) class="table-warning" @endif>
                        <td>{{ $cliente->dni }}</td>
                        <td>{{ $cliente->nombre }}</td>
                        <td>{{ $cliente->apellidos }}</td>
                        <td>{{ $cliente->mail }}</td>
                        <td>{{ $cliente->es_admin ? '✅' : '❌' }}</td>
                        <td>
                            <a href="/clientes/{{ $cliente->dni }}" class="btn btn-primary">Ver</a>
                            <a href="/clientes/deletecliente/{{ $cliente->id }}" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    @include('main.includes.footer')
</body>
