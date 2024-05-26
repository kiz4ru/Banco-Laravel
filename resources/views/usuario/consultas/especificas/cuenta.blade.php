@include('main.includes.head')

<body>
    @include('main.includes.navbar')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="card align-items-center">
                    <div class="card-header">
                        <h2 class="class-title">Información de la cuenta</h2>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">#️⃣ IBAN: {{ $cuenta->id }}</h4>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">💵 Balance: {{ $cuenta->balance }}&euro;</li>
                        <li class="list-group-item">👤 Nombre Cliente: {{ $cuenta->cliente->nombre }}</li>
                        <li class="list-group-item">📅 Fecha de creación: {{ $cuenta->created_at }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-1 mb-5">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="card align-items-center">
                    <div class="card-header">
                        <h2 class="class-title">Últimas transferencias de la cuenta</h2>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">Cuenta Destino</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Fecha</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $transferencias = $cuenta->transferencias->sortByDesc('created_at');
                                @endphp
                                @foreach ($transferencias as $transferencia)
                                    <tr>
                                        <td>{{ $transferencia->cuenta_destino }}</td>
                                        <td>{{ $transferencia->cantidad }}&euro;</td>
                                        <td>{{ $transferencia->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @include('main.includes.footer')
</body>
