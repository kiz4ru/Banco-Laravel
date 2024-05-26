@include('main.includes.head')

<body>
    @include('main.includes.navbar')
    <div class="d-flex justify-content-center mb-3 mt-3">
        <div class="d-flex flex-column mb-3 mt-3 w-25">
            <img src="/storage/img/iconoapp.png" alt="IconoWeb" class="mx-auto mb-3" width="100" height="100">
            <h2 class="text-center mb-3">Registro de cuentas</h2>

            @isset($success)
                <div class="alert alert-success">¡Cliente registrado correctamente!</div>
            @endisset

            @isset($errorServidor)
                <div class="alert alert-danger">Ha ocurrido un error al procesar la petición</div>
            @endisset

            <form action="/register" method="POST">
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

                <!-- Input mail-->
                <div class="form-outline form-floating mb-3">
                    <input required inputmode="email" type="email" id="input_mail"
                        class=" 
                        form-control

                        @error('mail') is-invalid @enderror
                        "
                        name="mail" placeholder="Correo electrónico" />
                    <label for="input_mail">Correo electrónico</label>
                    @error('mail')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input nombre-->
                <div class="form-outline form-floating mb-3">
                    <input required type="text" id="input_nombre"
                        class="
                    form-control
                    
                    @error('nombre') is-invalid @enderror
                    "
                        name="nombre" placeholder="Nombre" />
                    <label for="input_nombre">Nombre</label>
                    @error('nombre')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input apellidos-->
                <div class="form-outline form-floating mb-3">
                    <input required type="text" id="input_apellidos"
                        class="
                    form-control
                    
                    @error('apellidos') is-invalid @enderror
                    "
                        name="apellidos" placeholder="Apellidos" />
                    <label for="input_apellidos">Apellidos</label>
                    @error('apellidos')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input clave -->
                <div class="form-outline form-floating mb-3">
                    <input required inputmode="numeric" pattern="[0-9]{6}" type="password" id="input_clave"
                        class="
                        form-control
                        
                        @error('clave') is-invalid @enderror
                        "
                        name="clave" placeholder="Clave numérica" />
                    <label for="input_clave">Clave numérica</label>
                    @error('clave')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Input Admin -->
                <div class="form-outline mb-3">
                    <input type="checkbox" id="input_admin" class="form-check-input" name="admin" value="1" />
                    <label for="input_admin">Administrador</label>
                </div>

                <!-- Submit button -->
                <button type="submit" class="btn btn-secondary w-100">Crear cuenta</button>
            </form>
        </div>
    </div>

    @include('main.includes.footer')
</body>
