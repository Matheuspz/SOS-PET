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

    <!-- Map Section -->
    <section id="locais" class="py-12 bg-gray-100 pt-24 md:pt-28">  <!-- Aumentado -->
        <div class="container mx-auto px-4">
            <!-- Título -->
            <div class="flex justify-between items-center mb-8">
                <h2 class="text-4xl font-bold">Locais</h2>
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
            <!-- Botão Próximos Evento -->
            <div class="py-16 text-center" >
                <a href="{{ route('events') }}"
                   class="inline-flex items-center gap-4 bg-[#72AE1D] hover:bg-[#7acc44] text-white text-2xl font-bold px-12 py-6 rounded-3xl transition-all hover:scale-105 shadow-lg">
                    <span>Próximos Eventos</span>
                    <i class="bi bi-arrow-right-circle-fill text-4xl"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Tips Section -->
    <section class="tips-section py-20">
        <div class="container mx-auto px-4">
            <h2 class="text-center text-4xl font-bold mb-10 text-black">Dicas de Cuidado</h2>

            <div class="flex justify-center mb-8">
                <div class="w-full max-w-xs">
                    <select id="petFilter" class="form-select w-full py-3 px-5 rounded-2xl text-lg border-2 border-gray-700 focus:border-[#72AE1D]">
                        <option value="dog">Cachorro</option>
                        <option value="cat">Gato</option>
                    </select>
                </div>
            </div>

            <div class="flex flex-col items-center">
                <!-- Desktop + Tablet: setas ao lado -->
                <div class="hidden md:flex justify-center items-center gap-6 w-full max-w-[800px]">
                    <button onclick="previousTip()" class="btn-arrow text-5xl text-gray-700 hover:text-[#72AE1D]">
                        <i class="bi bi-arrow-left-circle-fill"></i>
                    </button>

                    <div class="tip-card flex-1">
                        <h4 id="tipTitle" class="text-[#72AE1D] text-3xl font-bold mb-4">Carregando...</h4>
                        <p id="tipText" class="text-gray-700 text-lg leading-relaxed">Dicas disponíveis para o tipo de animal selecionado.</p>
                    </div>

                    <button onclick="nextTip()" class="btn-arrow text-5xl text-gray-700 hover:text-[#72AE1D]">
                        <i class="bi bi-arrow-right-circle-fill"></i>
                    </button>
                </div>

                <!-- Mobile: Card centralizado + setas embaixo -->
                <div class="md:hidden w-full max-w-md">
                    <div class="tip-card">
                        <h4 id="tipTitle" class="text-[#72AE1D] text-3xl font-bold mb-4">Carregando...</h4>
                        <p id="tipText" class="text-gray-700 text-lg leading-relaxed">Dicas disponíveis para o tipo de animal selecionado.</p>
                    </div>

                    <div class="flex justify-center gap-8 mt-6">
                        <button onclick="previousTip()" class="btn-arrow text-4xl text-gray-700 hover:text-[#72AE1D]">
                            <i class="bi bi-arrow-left-circle-fill"></i>
                        </button>
                        <button onclick="nextTip()" class="btn-arrow text-4xl text-gray-700 hover:text-[#72AE1D]">
                            <i class="bi bi-arrow-right-circle-fill"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contato" class="py-20 bg-gradient-to-b from-[#59e0d4] to-[#dceb45]">
        <div class="container mx-auto px-4">
            <div class="contact-box mx-auto max-w-2xl p-10 md:p-12">
                <h2 class="text-center text-4xl font-bold mb-10 text-white drop-shadow-sm">
                    Formulário para contato
                </h2>
                <form id="contactForm" class="space-y-6">
                    @csrf
                    <div>
                        <input
                            type="text"
                            name="name"
                            class="form-input w-full px-6 py-4 rounded-2xl text-lg focus:outline-none focus:ring-4 focus:ring-white/50"
                            placeholder="Nome"
                            required>
                    </div>
                    <div>
                        <input
                            type="email"
                            name="email"
                            class="form-input w-full px-6 py-4 rounded-2xl text-lg focus:outline-none focus:ring-4 focus:ring-white/50"
                            placeholder="E-mail"
                            required>
                    </div>
                    <div>
                    <textarea
                        name="message"
                        rows="6"
                        class="form-input w-full px-6 py-4 rounded-3xl text-lg resize-y focus:outline-none focus:ring-4 focus:ring-white/50"
                        placeholder="Mensagem"
                        required></textarea>
                    </div>
                    <button
                        type="submit"
                        class="w-full bg-[#1e8a2e] hover:bg-[#2aa13a] text-white font-bold py-5 text-xl rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl">
                        ENVIAR
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- About Section -->
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
