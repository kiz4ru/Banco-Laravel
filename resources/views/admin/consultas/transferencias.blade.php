@include('main.includes.head')

<body>
    @include('main.includes.navbar')

    <div class="mt-3 mb-3 text-center">
        <h1>Transferencias</h1>
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th>ID Transferencia</th>
                    <th>Cuenta Origen</th>
                    <th>Cuenta Destino</th>
                    <th>Cantidad</th>
                    <!--<th>Acciones</th>-->
                </tr>
            </thead>
            <tbody>
                @foreach ($transferencias as $transferencia)
                    <tr>
                        <td>{{ $transferencia->id }}</td>
                        <td>{{ $transferencia->cuenta_origen }}</td>
                        <td>{{ $transferencia->cuenta_destino }}</td>
                        <td>{{ $transferencia->cantidad }}</td>
                        <!--<td>
                            <a href="/transferencias/{{ $transferencia->id }}" class="btn btn-primary">Ver</a>
                        </td>-->
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    @include('main.includes.footer')
</body>
