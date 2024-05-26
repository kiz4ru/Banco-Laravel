@logueado
<nav class="navbar" style="background-color: #0a4275">
    <div class="container">
        @if (session('cliente'))
            @if (session('cliente')->es_admin)
                <a class="navbar-brand text-white" href="/administracion">
                    <img src="/storage/img/iconoapp.png" alt="IconoWeb" width="30" height="24">
                    {{ config('app.name') }}
                </a>
            @else
                <a class="navbar-brand text-white" href="/inicio">
                    <img src="/storage/img/iconoapp.png" alt="IconoWeb" width="30" height="24">
                    {{ config('app.name') }}
                </a>
            @endif
        @else
        @endif
    </div>
        <span class="text-white m-2">{{ session('cliente')->nombre }}</span>
        <a class="btn btn-warning me-2" href="/logout">Cerrar sesión</a>
</nav>
@endlogueado
