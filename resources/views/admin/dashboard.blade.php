@extends('layouts.app')

@section('title', 'Admin Dashboard - SOS PET')

@section('content')
    <div class="min-h-screen bg-gray-100">
        <!-- Header -->
        <header class="bg-white shadow">
            <div class="container mx-auto px-4 py-6 flex justify-between items-center">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('img/logo.jfif') }}" alt="Logo" class="w-10 h-10 rounded">
                    <h1 class="text-2xl font-bold text-gray-900">SOS PET Admin</h1>
                </div>

                <div class="flex items-center gap-4">
                    <span class="text-gray-700">
                        <i class="bi bi-person-circle mr-2"></i>
                        Admin
                    </span>
                    <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-700 font-bold">
                            <i class="bi bi-box-arrow-left mr-2"></i>Logout
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <div class="container mx-auto px-4 py-8">
            <!-- Tabs Navigation -->
            <div class="flex gap-4 mb-8 border-b border-gray-300 overflow-x-auto">
                <button
                    onclick="showTab('events')"
                    class="tab-btn text-green-600 border-b-2 border-green-600 pb-2 font-bold px-4 whitespace-nowrap"
                    id="tab-events"
                >
                    <i class="bi bi-calendar-event mr-2"></i>Eventos
                </button>
                <button
                    onclick="showTab('tips')"
                    class="tab-btn text-gray-600 pb-2 font-bold px-4 hover:text-green-600 whitespace-nowrap"
                    id="tab-tips"
                >
                    <i class="bi bi-lightbulb mr-2"></i>Dicas
                </button>
                <button
                    onclick="showTab('markers')"
                    class="tab-btn text-gray-600 pb-2 font-bold px-4 hover:text-green-600 whitespace-nowrap"
                    id="tab-markers"
                >
                    <i class="bi bi-geo-alt mr-2"></i>Marcadores do Mapa
                </button>
                <button
                    onclick="showTab('map')"
                    class="tab-btn text-gray-600 pb-2 font-bold px-4 hover:text-green-600 whitespace-nowrap"
                    id="tab-map"
                >
                    <i class="bi bi-map mr-2"></i>Visualizar Mapa
                </button>
            </div>

            <!-- EVENTS TAB -->
            <div id="events-tab" class="tab-content">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Add Event Form -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">
                            <i class="bi bi-plus-circle text-green-600 mr-2"></i>Novo Evento
                        </h2>

                        <!-- TODO: Connect to backend API when ready -->
                        <form id="eventForm" class="space-y-4">
                            @csrf

                            <input
                                type="text"
                                id="eventTitle"
                                placeholder="Título do evento"
                                class="w-full px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-green-500"
                                required
                            >

                            <input
                                type="date"
                                id="eventDate"
                                class="w-full px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-green-500"
                                required
                            >

                            <textarea
                                id="eventDescription"
                                placeholder="Descrição do evento"
                                rows="4"
                                class="w-full px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-green-500"
                                required
                            ></textarea>

                            <button
                                type="submit"
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded-lg transition"
                            >
                                <i class="bi bi-plus mr-2"></i>Adicionar Evento
                            </button>

                            <div class="text-xs text-blue-600 bg-blue-50 p-3 rounded">
                                <i class="bi bi-info-circle"></i> Conectar ao backend quando pronto
                            </div>
                        </form>
                    </div>

                    <!-- Events List -->
                    <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">
                            <i class="bi bi-list mr-2"></i>Eventos Existentes
                        </h2>

                        <div id="eventsList" class="space-y-4">
                            @forelse ($events as $event)
                                <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-green-500 transition">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h4 class="font-bold text-gray-900">{{ $event['title'] }}</h4>
                                            <p class="text-sm text-gray-600">📅 {{ $event['date'] }}</p>
                                        </div>
                                        <div class="flex gap-2">
                                            <button
                                                onclick="editEvent({{ $event['id'] }})"
                                                class="text-blue-600 hover:text-blue-700 font-bold text-sm"
                                                title="Editar"
                                            >
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button
                                                onclick="deleteEvent({{ $event['id'] }})"
                                                class="text-red-600 hover:text-red-700 font-bold text-sm"
                                                title="Deletar"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-700">{{ $event['description'] }}</p>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-8">Nenhum evento cadastrado</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- TIPS TAB -->
            <div id="tips-tab" class="tab-content hidden">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Add Tip Form -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">
                            <i class="bi bi-plus-circle text-green-600 mr-2"></i>Nova Dica
                        </h2>

                        <!-- TODO: Connect to backend API when ready -->
                        <form id="tipForm" class="space-y-4">
                            @csrf

                            <input
                                type="text"
                                id="tipTitle"
                                placeholder="Título da dica"
                                class="w-full px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-green-500"
                                required
                            >

                            <select
                                id="tipType"
                                class="w-full px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-green-500"
                                required
                            >
                                <option value="dog">Cachorro</option>
                                <option value="cat">Gato</option>
                            </select>

                            <textarea
                                id="tipDescription"
                                placeholder="Descrição da dica"
                                rows="4"
                                class="w-full px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-green-500"
                                required
                            ></textarea>

                            <button
                                type="submit"
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded-lg transition"
                            >
                                <i class="bi bi-plus mr-2"></i>Adicionar Dica
                            </button>

                            <div class="text-xs text-blue-600 bg-blue-50 p-3 rounded">
                                <i class="bi bi-info-circle"></i> Conectar ao backend quando pronto
                            </div>
                        </form>
                    </div>

                    <!-- Tips List -->
                    <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">
                            <i class="bi bi-list mr-2"></i>Dicas Existentes
                        </h2>

                        <div id="tipsList" class="space-y-4">
                            @forelse ($tips as $tip)
                                <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-green-500 transition">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h4 class="font-bold text-gray-900">{{ $tip['title'] }}</h4>
                                            <p class="text-sm text-gray-600">
                                                {{ $tip['type'] === 'dog' ? '🐕 Cachorro' : '🐱 Gato' }}
                                            </p>
                                        </div>
                                        <div class="flex gap-2">
                                            <button
                                                onclick="editTip({{ $tip['id'] }})"
                                                class="text-blue-600 hover:text-blue-700 font-bold text-sm"
                                                title="Editar"
                                            >
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button
                                                onclick="deleteTip({{ $tip['id'] }})"
                                                class="text-red-600 hover:text-red-700 font-bold text-sm"
                                                title="Deletar"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-700">{{ $tip['description'] }}</p>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-8">Nenhuma dica cadastrada</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- MARKERS TAB -->
            <div id="markers-tab" class="tab-content hidden">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Add Marker Form -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">
                            <i class="bi bi-plus-circle text-green-600 mr-2"></i>Novo Marcador
                        </h2>

                        <!-- TODO: Connect to backend API when ready -->
                        <form id="markerForm" class="space-y-4">
                            @csrf

                            <input
                                type="text"
                                id="markerTitle"
                                placeholder="Título do marcador"
                                class="w-full px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-green-500"
                                required
                            >

                            <select
                                id="markerType"
                                class="w-full px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-green-500"
                                required
                            >
                                <option value="donation">🟠 Doação</option>
                                <option value="hospital">🔵 Hospital Veterinário</option>
                                <option value="event">🔴 Evento</option>
                            </select>

                            <input
                                type="number"
                                id="markerLatitude"
                                placeholder="Latitude (-23.5505)"
                                step="0.0001"
                                class="w-full px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-green-500"
                                required
                            >

                            <input
                                type="number"
                                id="markerLongitude"
                                placeholder="Longitude (-46.6333)"
                                step="0.0001"
                                class="w-full px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-green-500"
                                required
                            >

                            <textarea
                                id="markerDescription"
                                placeholder="Descrição do marcador"
                                rows="3"
                                class="w-full px-3 py-2 border-2 border-gray-300 rounded-lg focus:outline-none focus:border-green-500"
                                required
                            ></textarea>

                            <button
                                type="submit"
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 rounded-lg transition"
                            >
                                <i class="bi bi-plus mr-2"></i>Adicionar Marcador
                            </button>

                            <div class="text-xs text-blue-600 bg-blue-50 p-3 rounded">
                                <i class="bi bi-info-circle"></i> Conectar ao backend quando pronto
                            </div>
                        </form>
                    </div>

                    <!-- Markers List -->
                    <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">
                            <i class="bi bi-list mr-2"></i>Marcadores Existentes
                        </h2>

                        <div id="markersList" class="space-y-4">
                            @forelse ($markers as $marker)
                                <div class="border-2 border-gray-200 rounded-lg p-4 hover:border-green-500 transition">
                                    <div class="flex justify-between items-start mb-2">
                                        <div>
                                            <h4 class="font-bold text-gray-900">{{ $marker['title'] }}</h4>
                                            <p class="text-sm text-gray-600">
                                                📍 {{ $marker['latitude'] }}, {{ $marker['longitude'] }}
                                            </p>
                                        </div>
                                        <div class="flex gap-2">
                                            <button
                                                onclick="editMarker({{ $marker['id'] }})"
                                                class="text-blue-600 hover:text-blue-700 font-bold text-sm"
                                                title="Editar"
                                            >
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <button
                                                onclick="deleteMarker({{ $marker['id'] }})"
                                                class="text-red-600 hover:text-red-700 font-bold text-sm"
                                                title="Deletar"
                                            >
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-700">{{ $marker['description'] }}</p>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center py-8">Nenhum marcador cadastrado</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <!-- MAP TAB -->
            <div id="map-tab" class="tab-content hidden">
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">
                        <i class="bi bi-map text-green-600 mr-2"></i>Visualizar Mapa com Marcadores
                    </h2>

                    <div id="adminMap"
                         class="w-full h-96 md:h-[500px] rounded-lg shadow-lg border-2 border-gray-200"></div>

                    <div class="mt-4 p-4 bg-gray-100 rounded-lg">
                        <h5 class="font-bold text-gray-900 mb-2">Legenda:</h5>
                        <div class="grid grid-cols-3 gap-4 text-sm">
                            <div>🟠 <span class="font-bold">Doação</span></div>
                            <div>🔵 <span class="font-bold">Hospital</span></div>
                            <div>🔴 <span class="font-bold">Evento</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS for responsive elements -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection

@section('scripts')
    <script>
        // Tab Switching
        function showTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });

            // Remove active state from all buttons
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('text-green-600', 'border-b-2', 'border-green-600');
                btn.classList.add('text-gray-600');
            });

            // Show selected tab
            document.getElementById(tabName + '-tab').classList.remove('hidden');

            // Add active state to clicked button
            const activeBtn = document.getElementById('tab-' + tabName);
            activeBtn.classList.add('text-green-600', 'border-b-2', 'border-green-600');
            activeBtn.classList.remove('text-gray-600');

            // Initialize map if it's the map tab
            if (tabName === 'map') {
                setTimeout(initAdminMap, 100);
            }
        }

        // Admin Map
        let adminMap;
        let adminMarkers = [];
        let markerIcons = {
            donation: '🟠',
            hospital: '🔵',
            event: '🔴'
        };

        function initAdminMap() {
            if (adminMap) return; // Already initialized

            adminMap = L.map('adminMap').setView([-23.5505, -46.6333], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors',
                maxZoom: 19,
            }).addTo(adminMap);

            // Load markers from the page data
            const markersData = {!! json_encode($markers) !!};
            markersData.forEach(markerData => {
                const markerIcon = markerIcons[markerData['type']] || '🔵';

                const customIcon = L.divIcon({
                    html: '<div class="text-3xl">' + markerIcon + '</div>',
                    iconSize: [40, 40],
                    className: 'custom-marker cursor-pointer'
                });

                const marker = L.marker([markerData['latitude'], markerData['longitude']], {
                    icon: customIcon
                }).addTo(adminMap);

                marker.bindPopup('<div class="text-center"><h5 class="font-bold">' + markerData['title'] + '</h5><p class="text-sm text-gray-600">' + markerData['description'] + '</p></div>');
            });
        }

        // Event Form Submission
        document.getElementById('eventForm').addEventListener('submit', function (e) {
            e.preventDefault();
            alert('TODO: Implementar conexão com backend quando pronto');
        });

        // Tip Form Submission
        document.getElementById('tipForm').addEventListener('submit', function (e) {
            e.preventDefault();
            alert('TODO: Implementar conexão com backend quando pronto');
        });

        // Marker Form Submission
        document.getElementById('markerForm').addEventListener('submit', function (e) {
            e.preventDefault();
            alert('TODO: Implementar conexão com backend quando pronto');
        });

        // Edit/Delete Functions (TODO: Implement with backend)
        function editEvent(id) {
            alert('TODO: Editar evento #' + id + ' - implementar com backend');
        }

        function deleteEvent(id) {
            if (confirm('Tem certeza que deseja deletar este evento?')) {
                alert('TODO: Deletar evento #' + id + ' - implementar com backend');
            }
        }

        function editTip(id) {
            alert('TODO: Editar dica #' + id + ' - implementar com backend');
        }

        function deleteTip(id) {
            if (confirm('Tem certeza que deseja deletar esta dica?')) {
                alert('TODO: Deletar dica #' + id + ' - implementar com backend');
            }
        }

        function editMarker(id) {
            alert('TODO: Editar marcador #' + id + ' - implementar com backend');
        }

        function deleteMarker(id) {
            if (confirm('Tem certeza que deseja deletar este marcador?')) {
                alert('TODO: Deletar marcador #' + id + ' - implementar com backend');
            }
        }

        // Initialize first tab
        showTab('events');
    </script>
@endsection
