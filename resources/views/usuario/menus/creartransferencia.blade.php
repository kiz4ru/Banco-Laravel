{{-- TODO Crear menu para realizar transferencias --}}
@include('main.includes.head')

<body>
    @include('main.includes.navbar')

    <div class="container mt-5 vh-100">

        @session('success')
            <div class="alert alert-success">¡Transferencia realizada correctamente!</div>
        @endsession

        @session('error')
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endsession

        @error('cuenta_origen')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @error('cuenta_destino')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @error('cantidad')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">Crear Transferencia</h1>
                <form action="/registertransferencias" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="cuenta_origen">Cuenta Origen</label>
                        <select class="form-control" id="cuenta_origen" name="cuenta_origen">
                            @foreach ($cuentas_cliente as $cuenta)
                                <option value="{{ $cuenta->id }}">🪪{{ $cuenta->id }} 💵{{ $cuenta->balance }}&euro;
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group form-floating mt-2">
                        <input type="text" class="form-control" id="cuenta_destino" name="cuenta_destino"
                            placeholder="Cuenta Destino">
                        <label for="cuenta_destino">Cuenta Destino</label>
                    </div>
                    <div class="form-group form-floating mt-2 mb-2">
                        <input type="number" step="0.01" class="form-control" id="cantidad" name="cantidad"
                            placeholder="Cantidad">
                        <label for="cantidad">Cantidad</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Crear Transferencia</button>
                </form>
            </div>
        </div>
    </div>


    @include('main.includes.footer')
</body>

</html>
