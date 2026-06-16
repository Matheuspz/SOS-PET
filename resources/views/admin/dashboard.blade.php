@extends('layouts.app')

@section('title', 'Dashboard Admin - SOS PET')

@section('content')
    @include('layouts.navbar')

    <div class="min-h-screen bg-gray-100 py-10">
        <div class="container mx-auto px-4 max-w-7xl">

            <!-- Cabeçalho -->
            <div class="flex justify-between items-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800">Dashboard Administrativo</h1>

                <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                            class="text-red-600 hover:text-red-700 font-medium underline underline-offset-4 hover:underline-offset-8 transition-all text-lg cursor-pointer">
                        SAIR
                    </button>
                </form>
            </div>

            <!-- ==================== FORMULÁRIOS ==================== -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">

                <!-- Form Dicas -->
                <div class="bg-white rounded-3xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold mb-6 flex items-center gap-3">
                        <i class="bi bi-lightbulb text-yellow-500"></i> Nova Dica
                    </h2>
                    <form action="{{ route('admin.dicas.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <input type="text" name="titulo" placeholder="Título da dica" class="w-full px-4 py-3 border rounded-2xl" required>
                        <select name="tipo" class="w-full px-4 py-3 border rounded-2xl cursor-pointer" required>
                            <option value="cao">🐶 Cachorro</option>
                            <option value="gato">🐱 Gato</option>
                        </select>
                        <textarea name="descricao" rows="4" placeholder="Descrição da dica..." class="w-full px-4 py-3 border rounded-2xl" required></textarea>
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-2xl transition cursor-pointer">
                            Salvar Dica
                        </button>
                    </form>
                </div>

                <!-- Form Eventos -->
                <div class="bg-white rounded-3xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold mb-6 flex items-center gap-3">
                        <i class="bi bi-calendar-event text-blue-500"></i> Novo Evento
                    </h2>
                    <form action="{{ route('admin.eventos.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <input type="text" name="titulo" placeholder="Título do evento" class="w-full px-4 py-3 border rounded-2xl" required>
                        <div class="grid grid-cols-2 gap-4">
                            <input type="date" name="data" class="w-full px-4 py-3 border rounded-2xl cursor-pointer" required>
                            <input type="time" name="hora" class="w-full px-4 py-3 border rounded-2xl cursor-pointer" required>
                        </div>
                        <textarea name="descricao" rows="4" placeholder="Descrição do evento..." class="w-full px-4 py-3 border rounded-2xl" required></textarea>
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-2xl transition cursor-pointer">
                            Salvar Evento
                        </button>
                    </form>
                </div>

                <!-- Form Marcadores -->
                <div class="bg-white rounded-3xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold mb-6 flex items-center gap-3">
                        <i class="bi bi-geo-alt text-red-500"></i> Novo Marcador
                    </h2>
                    <form action="{{ route('admin.marcadores.store') }}" method="POST" class="space-y-5">
                        @csrf
                        <input type="text" name="titulo" placeholder="Nome do local (ex: Casa da Maria)"
                               class="w-full px-4 py-3 border rounded-2xl" required>

                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" name="latitude" placeholder="Latitude"
                                   class="w-full px-4 py-3 border rounded-2xl" required>
                            <input type="text" name="longitude" placeholder="Longitude"
                                   class="w-full px-4 py-3 border rounded-2xl" required>
                        </div>

                        <!-- Campo Tipo -->
                        <select name="tipo" class="w-full px-4 py-3 border rounded-2xl cursor-pointer" required>
                            <option value="">Selecione o tipo de marcador</option>
                            <option value="doacao">📦 Doação (Laranja)</option>
                            <option value="hospital">🏥 Hospital Veterinário (Azul)</option>
                            <option value="evento">🎉 Evento (Vermelho)</option>
                        </select>

                        <textarea name="descricao" rows="3" placeholder="Descrição (opcional)"
                                  class="w-full px-4 py-3 border rounded-2xl"></textarea>

                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-2xl transition cursor-pointer">
                            Salvar Marcador
                        </button>
                    </form>
                </div>
            </div>

            <!-- ==================== LISTAGENS ==================== -->
            <div class="space-y-12">

                <!-- Dicas -->
                <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
                    <div onclick="toggleSection('dicas')"
                         class="flex items-center justify-between px-8 py-6 cursor-pointer hover:bg-gray-50 transition">
                        <h3 class="text-2xl font-bold flex items-center gap-3">
                            <i class="bi bi-lightbulb text-yellow-500"></i>
                            Dicas Cadastradas
                        </h3>
                        <i id="chevron-dicas" class="bi bi-chevron-down text-2xl transition-transform duration-300"></i>
                    </div>
                    <div id="content-dicas" class="px-8 pb-8">
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse($dicas as $dica)
                                <div class="bg-white border rounded-3xl p-6 shadow hover:shadow-lg transition relative">
                                    <div class="absolute top-4 right-4 flex gap-2">
                                        <a href="{{ route('admin.dicas.edit', $dica) }}" class="text-blue-600 hover:text-blue-700">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.dicas.destroy', $dica) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir esta dica?')"
                                                    class="text-red-600 hover:text-red-700">
                                                <i class="bi bi-trash cursor-pointer"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <h4 class="font-bold text-lg mb-2">{{ $dica->titulo }}</h4>
                                    <p class="text-sm text-gray-500 mb-2">{{ $dica->tipo === 'cao' ? '🐶 Cachorro' : '🐱 Gato' }}</p>
                                    <p class="text-gray-600 text-sm line-clamp-4">{{ $dica->descricao }}</p>
                                </div>
                            @empty
                                <p class="text-gray-500 py-8">Nenhuma dica cadastrada.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Eventos -->
                <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
                    <div onclick="toggleSection('eventos')"
                         class="flex items-center justify-between px-8 py-6 cursor-pointer hover:bg-gray-50 transition">
                        <h3 class="text-2xl font-bold flex items-center gap-3">
                            <i class="bi bi-calendar-event text-blue-500"></i>
                            Eventos Cadastrados
                        </h3>
                        <i id="chevron-eventos" class="bi bi-chevron-down text-2xl transition-transform duration-300"></i>
                    </div>
                    <div id="content-eventos" class="px-8 pb-8">
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse($eventos as $evento)
                                <div class="bg-white border rounded-3xl p-6 shadow hover:shadow-lg transition relative">
                                    <div class="absolute top-4 right-4 flex gap-2">
                                        <a href="{{ route('admin.eventos.edit', $evento) }}" class="text-blue-600 hover:text-blue-700">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.eventos.destroy', $evento) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este evento?')"
                                                    class="text-red-600 hover:text-red-700">
                                                <i class="bi bi-trash cursor-pointer"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <h4 class="font-bold text-lg mb-2">{{ $evento->titulo }}</h4>
                                    <p class="text-sm text-gray-500">{{ $evento->data }} • {{ $evento->hora }}</p>
                                    <p class="text-gray-600 text-sm line-clamp-4 mt-3">{{ $evento->descricao }}</p>
                                </div>
                            @empty
                                <p class="text-gray-500 py-8">Nenhum evento cadastrado.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Marcadores -->
                <div class="bg-white rounded-3xl shadow-lg overflow-hidden">
                    <div onclick="toggleSection('marcadores')"
                         class="flex items-center justify-between px-8 py-6 cursor-pointer hover:bg-gray-50 transition">
                        <h3 class="text-2xl font-bold flex items-center gap-3">
                            <i class="bi bi-geo-alt text-red-500"></i>
                            Marcadores Cadastrados
                        </h3>
                        <i id="chevron-marcadores" class="bi bi-chevron-down text-2xl transition-transform duration-300"></i>
                    </div>
                    <div id="content-marcadores" class="px-8 pb-8">
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @forelse($marcadores as $marcador)
                                <div class="bg-white border rounded-3xl p-6 shadow hover:shadow-lg transition relative">
                                    <div class="absolute top-4 right-4 flex gap-2">
                                        <a href="{{ route('admin.marcadores.edit', $marcador) }}" class="text-blue-600 hover:text-blue-700">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <form action="{{ route('admin.marcadores.destroy', $marcador) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Tem certeza que deseja excluir este marcador?')"
                                                    class="text-red-600 hover:text-red-700">
                                                <i class="bi bi-trash cursor-pointer"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <h4 class="font-bold text-lg mb-2">{{ $marcador->titulo }}</h4>
                                    <p class="text-sm text-gray-500">{{ $marcador->latitude }}, {{ $marcador->longitude }}</p>
                                    <p class="text-xs inline-block bg-gray-100 px-3 py-1 rounded-full mt-2">{{ $marcador->tipo }}</p>
                                    @if($marcador->descricao)
                                        <p class="text-gray-600 text-sm line-clamp-3 mt-3">{{ $marcador->descricao }}</p>
                                    @endif
                                </div>
                            @empty
                                <p class="text-gray-500 py-8">Nenhum marcador cadastrado.</p>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('layouts.footer')
@endsection

@section('scripts')
    <script>
        function toggleSection(section) {
            const content = document.getElementById(`content-${section}`);
            const chevron = document.getElementById(`chevron-${section}`);

            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                chevron.style.transform = 'rotate(180deg)';
            } else {
                content.classList.add('hidden');
                chevron.style.transform = 'rotate(0deg)';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Se quiser que comece aberto, comente as linhas abaixo:
            document.getElementById('content-dicas').classList.add('hidden');
            document.getElementById('content-eventos').classList.add('hidden');
            document.getElementById('content-marcadores').classList.add('hidden');
        });
    </script>
@endsection
