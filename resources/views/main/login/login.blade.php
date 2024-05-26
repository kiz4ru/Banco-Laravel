@include('main.includes.head')

<body>
    @include('main.includes.navbar')

    <div class="d-flex justify-content-center mb-5 mt-5">
        <div class="d-flex flex-column mb-3 mt-3 w-25">
            <img src="/storage/img/iconoapp.png" alt="IconoWeb" class="mx-auto mb-3" width="100" height="100">
            <h2 class="text-center mb-3">Iniciar sesión</h2>

            @session('error')
                <div class="alert alert-danger">{{ $value }}</div>
            @endsession

            <form action="/login" method="POST">
                @csrf
                <!-- Input mail-->
                <div class="form-outline form-floating mb-3">
                    <input required type="text" id="input_dni" 
                    class="
                    form-control
                    @error('dni') is-invalid @enderror
                    " name="dni"
                        placeholder="DNI" />
                        @error('dni')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    <label for="input_dni">DNI</label>
                </div>

                <!-- Input clave -->
                <div class="form-outline form-floating mb-3">
                    <input required inputmode="numeric" pattern="[0-9]{6}" type="password" id="input_clave"
                        class="
                        form-control
                        @error('clave') is-invalid @enderror
                        " name="clave" placeholder="Clave numérica" />
                        @error('clave')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    <label for="input_clave">Clave numérica</label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-secondary w-100">Iniciar sesión</button>
            </form>
        </div>
    </div>

</body>
