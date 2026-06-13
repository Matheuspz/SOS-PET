@extends('layouts.app')

@section('title', 'Dashboard Admin - SOS PET')

@section('content')
    @include('layouts.navbar')

    <div class="min-h-screen bg-gray-100 py-10">
        <div class="container mx-auto px-4 max-w-7xl">

            <h1 class="text-4xl font-bold text-center mb-10 text-gray-800">Dashboard Administrativo</h1>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- ==================== FORMULÁRIO DE DICAS ==================== -->
                <div class="bg-white rounded-3xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold mb-6 flex items-center gap-3">
                        <i class="bi bi-lightbulb text-yellow-500"></i> Nova Dica
                    </h2>
                    <form action="{{ route('admin.dicas.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <input type="text" name="titulo" placeholder="Título da dica" class="w-full px-4 py-3 border rounded-2xl" required>

                        <select name="tipo" class="w-full px-4 py-3 border rounded-2xl" required>
                            <option value="cao">🐶 Cachorro</option>
                            <option value="gato">🐱 Gato</option>
                        </select>

                        <textarea name="descricao" rows="4" placeholder="Descrição da dica..." class="w-full px-4 py-3 border rounded-2xl" required></textarea>

                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-2xl transition">
                            Salvar Dica
                        </button>
                    </form>
                </div>

                <!-- ==================== FORMULÁRIO DE EVENTOS ==================== -->
                <div class="bg-white rounded-3xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold mb-6 flex items-center gap-3">
                        <i class="bi bi-calendar-event text-blue-500"></i> Novo Evento
                    </h2>
                    <form action="{{ route('admin.eventos.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <input type="text" name="titulo" placeholder="Título do evento" class="w-full px-4 py-3 border rounded-2xl" required>

                        <div class="grid grid-cols-2 gap-4">
                            <input type="date" name="data" class="w-full px-4 py-3 border rounded-2xl" required>
                            <input type="time" name="hora" class="w-full px-4 py-3 border rounded-2xl" required>
                        </div>

                        <textarea name="descricao" rows="4" placeholder="Descrição do evento..." class="w-full px-4 py-3 border rounded-2xl" required></textarea>

                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-2xl transition">
                            Salvar Evento
                        </button>
                    </form>
                </div>

                <!-- ==================== FORMULÁRIO DE MARCADORES ==================== -->
                <div class="bg-white rounded-3xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold mb-6 flex items-center gap-3">
                        <i class="bi bi-geo-alt text-red-500"></i> Novo Marcador
                    </h2>
                    <form action="{{ route('admin.marcadores.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <input type="text" name="titulo" placeholder="Nome do local" class="w-full px-4 py-3 border rounded-2xl" required>

                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" name="latitude" placeholder="Latitude" class="w-full px-4 py-3 border rounded-2xl" required>
                            <input type="text" name="longitude" placeholder="Longitude" class="w-full px-4 py-3 border rounded-2xl" required>
                        </div>

                        <select name="tipo" class="w-full px-4 py-3 border rounded-2xl" required>
                            <option value="hospital">🏥 Hospital Veterinário</option>
                            <option value="doacao">📦 Ponto de Doação</option>
                            <option value="evento">🎉 Evento</option>
                        </select>

                        <textarea name="descricao" rows="3" placeholder="Descrição (opcional)" class="w-full px-4 py-3 border rounded-2xl"></textarea>

                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-2xl transition">
                            Salvar Marcador
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    @include('layouts.footer')
@endsection
