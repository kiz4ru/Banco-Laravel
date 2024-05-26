@include('main.includes.head')

<body>
    @include('main.includes.navbar')

    <div class="d-flex justify-content-center mt-3 vh-100">
        <div class="d-flex flex-column mb-3 mt-3 w-25">
            <img src="/storage/img/iconoapp.png" alt="IconoWeb" class="mx-auto mb
            -3" width="100" height="100">
            <h2 class="text-center mb-3">Registro de cuentas</h2>

            @isset($success)
                <div class="alert alert-success">{{ $success }}</div>
            @endisset

            @isset($error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endisset

            <form action="/registercuentas" method="POST">
                @csrf
                <!-- Input DNI-->
                <div class="form-outline form-floating mb-3">
                    <input required type="text" id="input_dni"
                        class=" 
                        form-control

                        @error('dni') is-invalid @enderror
                        "
                        name="dni" placeholder="DNI" />
                    <label for="input_dni">DNI</label>
                    @error('dni')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Input balance de cuenta-->
                <div class="form-outline form-floating mb-3">
                    <input required type="number" id="input_balance"
                        class=" 
                        form-control

                        @error('balance') is-invalid @enderror
                        "
                        name="balance" placeholder="Balance" value="0.00" step="0.01" />
                    <label for="input_balance">Balance</label>
                    @error('balance')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-secondary w-100">Crear cuenta</button>
            </form>
        </div>
    </div>

    @include('main.includes.footer')
</body>
