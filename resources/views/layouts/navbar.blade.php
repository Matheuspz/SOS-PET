<!-- Header de navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container mx-auto px-4">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('home') }}">
            <img src="{{ asset('img/logo.jfif') }}"
                 alt="Logo SOS PET"
                 width="70"
                 height="64"
                 class="d-inline-block align-text-center me-3">
            <span class="fs-4">SOS PET - Patinhas Carentes</span>
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto gap-3">
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold px-4 py-2 rounded" href="#locais">
                        Locais
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold px-4 py-2 rounded" href="#sobre">
                        Sobre
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white fw-bold px-4 py-2 rounded" href="#contato">
                        Contato
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
