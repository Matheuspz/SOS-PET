@extends('layouts.app')

@section('title', 'SOS PET - Patinhas Carentes')

@section('content')
    @include('layouts.navbar')

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="max-w-5xl mx-auto px-6 text-center flex flex-col items-center justify-center h-full text-black">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-black mb-6 leading-tight tracking-tight">
                💚 Toda vida merece respeito
            </h1>
            <p class="lead text-xl md:text-2xl font-medium max-w-2xl mx-auto text-balance">
                ONG de proteção animal | Resgate, cuidado e adoção
            </p>
        </div>
    </section>

    <!-- Mapa Section -->
    <section id="locais" class="py-12 bg-gray-100 pt-24 md:pt-28">
        <div class="container mx-auto px-4">

            <div class="flex justify-center items-center mb-8">
                <h2 class="text-4xl font-bold text-center">Locais</h2>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Mapa -->
                <div class="flex-1">
                    <div id="map" class="rounded-3xl shadow-xl w-full"></div>
                </div>

                <!-- Legenda -->
                <div class="w-full lg:w-80 flex-shrink-0">
                    <div class="legend-box bg-white p-8 rounded-3xl shadow-sm sticky top-8">
                        <h5 class="font-bold mb-6 text-2xl text-gray-800">Legenda</h5>
                        <div class="space-y-5 text-lg">
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">🟠</span>
                                <span>Doação</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">🔵</span>
                                <span>Hospital Veterinário</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-2xl">🔴</span>
                                <span>Evento</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Eventos -->
            <div class="py-16 text-center">
                <a href="{{ route('events') }}"
                   class="inline-flex items-center gap-4 bg-[#72AE1D] hover:bg-[#7acc44] text-white text-2xl font-bold px-12 py-6 rounded-3xl transition-all hover:scale-105 shadow-lg">
                    <span>Próximos Eventos</span>
                    <i class="bi bi-arrow-right-circle-fill text-4xl"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Tips Section -->
    <section class="tips-section py-24 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-center text-4xl font-bold mb-10 text-black">Dicas de Cuidado</h2>

            <!-- Filtro -->
            <div class="flex justify-center mb-10">
                <div class="w-full max-w-xs">
                    <select id="petFilter" onchange="filterTips(this.value)"
                            class="form-select w-full py-3 px-5 rounded-2xl text-lg border-2 border-gray-700 focus:border-[#72AE1D]">
                        <option value="all">Todas as Dicas</option>
                        <option value="cao">🐶 Apenas para Cachorros</option>
                        <option value="gato">🐱 Apenas para Gatos</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-col items-center">

                <!-- Container do Carrossel -->
                <div class="relative w-full max-w-2xl mx-auto" style="height: 380px;">
                    @forelse($dicas as $index => $dica)
                        <div class="tip-slide absolute inset-0 transition-all duration-500 flex items-center justify-center {{ $index === 0 ? 'opacity-100' : 'opacity-0 pointer-events-none' }}"
                             data-index="{{ $index }}" data-tipo="{{ $dica->tipo }}">

                            <div class="tip-card bg-white p-10 md:p-14 rounded-3xl shadow-2xl text-center max-w-lg w-full mx-auto">
                                <div class="flex justify-center mb-6">
                                <span class="text-7xl">
                                    {{ $dica->tipo === 'cao' ? '🐶' : '🐱' }}
                                </span>
                                </div>
                                <h4 class="text-[#72AE1D] text-3xl font-bold mb-6 leading-tight">{{ $dica->titulo }}</h4>
                                <p class="text-gray-700 text-lg leading-relaxed">{{ $dica->descricao }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-20">
                            <p class="text-gray-500 text-xl">Nenhuma dica cadastrada ainda.</p>
                        </div>
                    @endforelse
                </div>

                <!-- Setas de Navegação -->
                <div class="flex items-center gap-12 mt-10">
                    <button onclick="prevTip()"
                            class="btn-arrow text-6xl text-gray-400 hover:text-[#72AE1D] transition-colors">
                        <i class="bi bi-arrow-left-circle-fill"></i>
                    </button>
                    <button onclick="nextTip()"
                            class="btn-arrow text-6xl text-gray-400 hover:text-[#72AE1D] transition-colors">
                        <i class="bi bi-arrow-right-circle-fill"></i>
                    </button>
                </div>

                <!-- Indicadores -->
                <div id="tip-indicators" class="flex gap-3 mt-10">
                    @foreach($dicas as $index => $dica)
                        <button onclick="goToTip({{ $index }})"
                                class="w-4 h-4 rounded-full transition-all {{ $index === 0 ? 'bg-[#72AE1D] scale-125' : 'bg-gray-300' }}">
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <!-- Sobre Nós Section -->
    <section id="sobre" class="py-20 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <img src="{{ asset('img/Familia.jpg') }}" class="rounded-3xl shadow-2xl w-full" alt="Família com pets">
                </div>
                <div>
                    <h3 class="text-4xl font-bold text-[#72AE1D] mb-6">Sobre nós</h3>
                    <p class="text-lg leading-relaxed text-gray-700 mb-6">
                        O Grupo Patinhas Carentes foi formado em 2008, quando universitárias começaram a se engajar na causa animal.
                        Iniciaram o projeto ajudando animais por intermédio de outros grupos de proteção e surgiu a necessidade de atender
                        os animais que se encontravam em situação de risco e nas ruas.
                        Fez-se necessário a criação da sede para abrigar esses animais que não tinham para onde ir.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    @include('layouts.footer')

@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

@endsection
