@extends('layouts.app')

@section('title', 'SOS PET - Patinhas Carentes')

@section('content')
    @include('layouts.navbar')

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="max-w-5xl mx-auto px-6 text-center flex flex-col items-center justify-center h-full">
            <h1 class="text-5xl md:text-6xl lg:text-7xl font-black mb-6 leading-tight tracking-tight">
                LOREM IPSUM DOLOR SIT AMET
            </h1>
            <p class="lead text-xl md:text-2xl font-medium max-w-2xl mx-auto text-balance">
                Lorem ipsum dolor sit amet,<br>
                consectetur adipiscing elit.<br>
                Nulla sagittis mi vitae vulputate.
            </p>
        </div>
    </section>

    <!-- Map Section -->
    <section id="locais" class="py-5 bg-gray-100">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
                <h2 class="text-4xl font-bold">Locais</h2>

                <div class="legend-box bg-white p-6 rounded-2xl shadow-sm">
                    <h5 class="font-bold mb-4 text-lg">Legenda</h5>
                    <div class="space-y-2">
                        <div>🟠 Doação</div>
                        <div>🔵 Hospital Veterinário</div>
                        <div>🔴 Evento</div>
                    </div>
                </div>
            </div>

            <!-- MAPA COM ALTURA DEFINIDA -->
            <div id="map" class="rounded-3xl shadow-xl"></div>
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

            <div class="flex justify-center items-center gap-6">
                <button onclick="previousTip()" class="btn-arrow text-6xl text-gray-700 hover:text-[#72AE1D] transition-transform hover:scale-110">
                    <i class="bi bi-arrow-left-circle-fill"></i>
                </button>

                <div class="tip-card">
                    <h4 id="tipTitle" class="text-[#72AE1D] text-3xl font-bold mb-4">Carregando...</h4>
                    <p id="tipText" class="text-gray-700 text-lg leading-relaxed">Dicas disponíveis para o tipo de animal selecionado.</p>
                </div>

                <button onclick="nextTip()" class="btn-arrow text-6xl text-gray-700 hover:text-[#72AE1D] transition-transform hover:scale-110">
                    <i class="bi bi-arrow-right-circle-fill"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section id="eventCarousel" class="py-20 bg-gray-100">
        <div class="container mx-auto px-4">
            <h2 class="text-center text-4xl font-bold mb-12">Eventos:</h2>

            <div id="eventsContainer" class="flex gap-6 overflow-x-auto pb-6 snap-x snap-mandatory scrollbar-hide">
                <!-- Populado via JS -->
            </div>

            <div class="flex justify-center gap-6 mt-8">
                <button onclick="scrollEvents('left')" class="btn-arrow text-5xl text-gray-700 hover:text-[#72AE1D]">
                    <i class="bi bi-arrow-left-circle-fill"></i>
                </button>
                <button onclick="scrollEvents('right')" class="btn-arrow text-5xl text-gray-700 hover:text-[#72AE1D]">
                    <i class="bi bi-arrow-right-circle-fill"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contato" class="py-20">
        <div class="container mx-auto px-4">
            <div class="contact-box mx-auto max-w-2xl">
                <h2 class="text-center text-3xl font-bold mb-8 text-white">Formulário para contato</h2>

                <form id="contactForm" class="space-y-5">
                    @csrf
                    <input type="text" name="name" class="form-control" placeholder="Nome" required>
                    <input type="email" name="email" class="form-control" placeholder="E-mail" required>
                    <textarea name="message" rows="6" class="form-control" placeholder="Mensagem" required></textarea>
                    <button type="submit" class="btn w-full py-4 text-lg font-bold">ENVIAR</button>
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
                        Somos uma ONG dedicada ao auxílio de animais em situação de vulnerabilidade.
                    </p>
                    <p class="text-lg leading-relaxed text-gray-700">
                        Nosso objetivo é conectar pessoas dispostas a ajudar com animais que precisam de apoio, seja através de adoção, doações ou participação em nossos eventos.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-16 border-t">
        <div class="container mx-auto px-4 text-center">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 text-2xl font-bold mb-6">
                <img src="{{ asset('img/logo.jfif') }}" alt="Logo" width="50" height="50">
                SOS PET - Patinhas Carentes
            </a>

            <div class="flex justify-center gap-8 text-3xl mb-6">
                <i class="bi bi-instagram cursor-pointer hover:text-[#72AE1D] transition-colors"></i>
                <i class="bi bi-youtube cursor-pointer hover:text-[#72AE1D] transition-colors"></i>
                <i class="bi bi-linkedin cursor-pointer hover:text-[#72AE1D] transition-colors"></i>
            </div>

            <small class="text-gray-500">SOS PET - PATINHAS CARENTES © 2026</small>
        </div>
    </footer>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>

        // Mobile Menu Toggle
        const mobileBtn = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        if (mobileBtn && mobileMenu) {
            mobileBtn.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');

                // Troca ícone entre hambúrguer e X
                const icon = mobileBtn.querySelector('i');
                if (icon.classList.contains('bi-list')) {
                    icon.classList.remove('bi-list');
                    icon.classList.add('bi-x-lg');
                } else {
                    icon.classList.add('bi-list');
                    icon.classList.remove('bi-x-lg');
                }
            });
        }

        /* ==================== LEAFLET MAP ==================== */
        let map;
        let markers = [];

        function initMap() {
            // Verifica se o mapa já existe para evitar erro
            if (map) {
                map.remove();
            }

            map = L.map('map', {
                zoomControl: true,
                scrollWheelZoom: true
            }).setView([-26.3044, -48.8487], 12);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; OpenStreetMap contributors',
                maxZoom: 19,
            }).addTo(map);

            // Força redesenho após carregamento
            setTimeout(() => {
                map.invalidateSize();
            }, 300);

            loadMarkers();
        }

        function loadMarkers() {
            fetch('/api/markers')
                .then(response => response.json())
                .then(data => {
                    data.forEach(marker => {
                        addMarker(marker);
                    });
                })
                .catch(err => console.error('Erro ao carregar marcadores:', err));
        }

        function addMarker(markerData) {
            const icons = {
                donation: '🟠',
                hospital: '🔵',
                event: '🔴'
            };

            const customIcon = L.divIcon({
                html: `<div style="font-size: 2.5rem;">${icons[markerData.type] || '🔵'}</div>`,
                iconSize: [50, 50],
                className: 'custom-marker'
            });

            const marker = L.marker([markerData.latitude, markerData.longitude], { icon: customIcon })
                .addTo(map)
                .bindPopup(`
            <div class="text-center">
                <strong>${markerData.title}</strong><br>
                <small class="text-muted">${markerData.description}</small>
            </div>
        `);

            markers.push(marker);
        }

        /* ==================== TIPS ==================== */
        let allTips = [];
        let filteredTips = [];
        let currentTipIndex = 0;

        function loadTips() {
            fetch('/api/tips')
                .then(res => res.json())
                .then(data => {
                    allTips = data;
                    filterTips('dog');
                })
                .catch(err => console.error(err));
        }

        function filterTips(type) {
            filteredTips = allTips.filter(tip => tip.type === type);
            currentTipIndex = 0;
            displayCurrentTip();
        }

        function displayCurrentTip() {
            if (filteredTips.length === 0) return;

            document.getElementById('tipTitle').textContent = filteredTips[currentTipIndex].title;
            document.getElementById('tipText').textContent = filteredTips[currentTipIndex].description;
        }

        function nextTip() {
            if (filteredTips.length === 0) return;
            currentTipIndex = (currentTipIndex + 1) % filteredTips.length;
            displayCurrentTip();
        }

        function previousTip() {
            if (filteredTips.length === 0) return;
            currentTipIndex = (currentTipIndex - 1 + filteredTips.length) % filteredTips.length;
            displayCurrentTip();
        }

        /* ==================== EVENTS ==================== */
        function loadEvents() {
            fetch('/api/events')
                .then(res => res.json())
                .then(events => {
                    const container = document.getElementById('eventsContainer');
                    container.innerHTML = '';

                    events.forEach(event => {
                        const card = document.createElement('div');
                        card.className = 'event-card';
                        card.innerHTML = `
                    <img src="${event.image}" alt="${event.title}" class="img-fluid rounded mb-3" style="height: 180px; object-fit: cover;">
                    <h6 class="fw-bold">${event.date}</h6>
                    <button class="btn btn-success btn-sm mt-2 mb-3" onclick="markOnMap(${event.latitude}, ${event.longitude})">
                        Marcar no mapa
                    </button>
                    <p class="mb-0">${event.description}</p>
                `;
                        container.appendChild(card);
                    });
                })
                .catch(err => console.error('Erro ao carregar eventos:', err));
        }

        function scrollEvents(direction) {
            const container = document.getElementById('eventsContainer');
            const scrollAmount = 380;
            container.scrollBy({
                left: direction === 'left' ? -scrollAmount : scrollAmount,
                behavior: 'smooth'
            });
        }

        function markOnMap(lat, lng) {
            if (map) {
                map.flyTo([lat, lng], 15, { duration: 2 });
            }
        }

        /* ==================== INIT ==================== */
        document.addEventListener('DOMContentLoaded', function() {
            initMap();
            loadTips();
            loadEvents();

            // Pet filter
            const petFilter = document.getElementById('petFilter');
            if (petFilter) {
                petFilter.addEventListener('change', function() {
                    filterTips(this.value);
                });
            }
        });
    </script>
@endsection
