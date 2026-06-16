@extends('layouts.admin')

@section('title', 'Editar Marcador - Admin')

@section('admin-content')
    <div class="bg-white rounded-3xl shadow-lg p-10">
        <h1 class="text-3xl font-bold mb-8">Editar Marcador</h1>

        <form action="{{ route('admin.marcadores.update', $marcador) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium mb-2">Título</label>

                    <input
                        type="text"
                        name="titulo"
                        value="{{ old('titulo', $marcador->titulo) }}"
                        class="w-full px-4 py-3 border rounded-2xl"
                        required
                    >
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">Latitude</label>

                        <input
                            type="text"
                            name="latitude"
                            value="{{ old('latitude', $marcador->latitude) }}"
                            class="w-full px-4 py-3 border rounded-2xl"
                            required
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Longitude</label>

                        <input
                            type="text"
                            name="longitude"
                            value="{{ old('longitude', $marcador->longitude) }}"
                            class="w-full px-4 py-3 border rounded-2xl"
                            required
                        >
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Tipo</label>

                    <select
                        name="tipo"
                        class="w-full px-4 py-3 border rounded-2xl"
                        required
                    >
                        <option value="doacao" {{ $marcador->tipo === 'doacao' ? 'selected' : '' }}>
                            📦 Doação
                        </option>

                        <option value="hospital" {{ $marcador->tipo === 'hospital' ? 'selected' : '' }}>
                            🏥 Hospital Veterinário
                        </option>

                        <option value="evento" {{ $marcador->tipo === 'evento' ? 'selected' : '' }}>
                            🎉 Evento
                        </option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Descrição</label>

                    <textarea
                        name="descricao"
                        rows="4"
                        class="w-full px-4 py-3 border rounded-2xl"
                    >{{ old('descricao', $marcador->descricao) }}</textarea>
                </div>

                <div class="flex gap-4">
                    <a
                        href="{{ route('admin.dashboard') }}"
                        class="flex-1 text-center py-4 border border-gray-300 rounded-2xl font-medium hover:bg-gray-50"
                    >
                        Cancelar
                    </a>

                    <button
                        type="submit"
                        class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-4 rounded-2xl transition"
                    >
                        Salvar Alterações
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
