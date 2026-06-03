<!-- Navbar -->
<nav class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-4 flex items-center justify-between">

        <!-- Logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img src="{{ asset('img/logo.jfif') }}"
                 alt="Logo SOS PET"
                 width="60"
                 height="60"
                 class="rounded-full">
            <div>
                <span class="text-2xl font-bold text-gray-800">SOS PET</span>
                <p class="text-sm text-gray-600 -mt-1">Patinhas Carentes</p>
            </div>
        </a>

        <!-- Menu Desktop -->
        <div class="hidden md:flex items-center gap-4">
            <a href="#locais"
               class="nav-btn">
                Locais
            </a>
            <a href="#sobre"
               class="nav-btn">
                Sobre
            </a>
            <a href="#contato"
               class="nav-btn">
                Contato
            </a>
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-button"
                class="md:hidden text-3xl text-gray-700">
            <i class="bi bi-list"></i>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-white border-t py-4">
        <div class="flex flex-col px-6 gap-3">
            <a href="#locais" class="nav-btn text-center py-3">Locais</a>
            <a href="#sobre" class="nav-btn text-center py-3">Sobre</a>
            <a href="#contato" class="nav-btn text-center py-3">Contato</a>
        </div>
    </div>
</nav>
