@include('main.includes.head')

<body>
    @include('main.includes.navbar')

    <div class="container mt-5 mb-5 text-center">
        <div class="card">
            <div class="card-header">
                <h1>Información cliente</h1>
            </div>
            <div class="card-body">
                <h3 class="card-title">🪪 {{ $cliente->dni }}</h3>
                <h5 class="card-title">👤 {{ $cliente->nombre }}, {{ $cliente->apellidos }}</h5>
                <p class="card-text">📧 {{ $cliente->mail }}</p>
            </div>
            <hr>
            <h4>Cuentas</h4>
            <div class="d-flex card-body">
                @foreach ($cliente->cuentas as $cuenta)
                    <div class="flex-column m-3">
                        <div class="card">
                            <div class="card-header">
                                <h5>{{ $cuenta->id }}</h5>
                            </div>
                            <div class="card-body">
                                <h5>{{ number_format($cuenta->balance, 2) }}&euro;</h5>
                            </div>
                            <div class="card-footer">
                                <a href="/cuenta/{{ $cuenta->id }}" class="btn btn-primary w-100">Ver</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <hr>
            <h4>Transferencias</h4>
            <p>Origen:🟩 Destino:🟨</p>
            <div class="d-flex flex-wrap card-body">
                @foreach ($cliente->cuentas as $cuenta)
                    @foreach ($cuenta->transferencias443187102 as $transferencia)
                        <div class="flex-column">
                            <div class="card">
                                <div class="card-header">
                                    <h5 title="{{ $transferencia->id }}">ID(Mantener ratón encima)</h5>
                                </div>
                                <div class="card-body">
                                    <h5 class="text-success">{{ $transferencia->cuenta_origen }}</h5>
                                    <hr>
                                    <h5 class="text-warning">{{ $transferencia->cuenta_destino }}</h5>
                                    <hr>
                                    <h5>{{ $transferencia->cantidad }}&euro;</h5>
                                </div>
                                <div class="card-footer">
                                    <a href="/transferencias/{{ $transferencia->id }}"
                                        class="btn btn-primary w-100">Ver</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

        @include('main.includes.footer')
</body>
