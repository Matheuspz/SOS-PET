@extends('layouts.admin')

@section('title', 'Editar Dica - Admin')

@section('admin-content')
    <div class="bg-white rounded-3xl shadow-lg p-10">
        <h1 class="text-3xl font-bold mb-8">Editar Dica</h1>

        <form action="{{ route('admin.dicas.update', $dica) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium mb-2">Título</label>
                    <input
                        type="text"
                        name="titulo"
                        value="{{ old('titulo', $dica->titulo) }}"
                        class="w-full px-4 py-3 border rounded-2xl"
                        required
                    >
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Tipo</label>

                    <select
                        name="tipo"
                        class="w-full px-4 py-3 border rounded-2xl"
                        required
                    >
                        <option value="cao" {{ $dica->tipo === 'cao' ? 'selected' : '' }}>
                            🐶 Cachorro
                        </option>

                        <option value="gato" {{ $dica->tipo === 'gato' ? 'selected' : '' }}>
                            🐱 Gato
                        </option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Descrição</label>

                    <textarea
                        name="descricao"
                        rows="5"
                        class="w-full px-4 py-3 border rounded-2xl"
                        required
                    >{{ old('descricao', $dica->descricao) }}</textarea>
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
