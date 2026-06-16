@extends('layouts.admin')

@section('title', 'Editar Evento - Admin')

@section('admin-content')
    <div class="bg-white rounded-3xl shadow-lg p-10">
        <h1 class="text-3xl font-bold mb-8">Editar Evento</h1>

        <form action="{{ route('admin.eventos.update', $evento) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium mb-2">Título</label>

                    <input
                        type="text"
                        name="titulo"
                        value="{{ old('titulo', $evento->titulo) }}"
                        class="w-full px-4 py-3 border rounded-2xl"
                        required
                    >
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-2">Data</label>

                        <input
                            type="date"
                            name="data"
                            value="{{ old('data', $evento->data) }}"
                            class="w-full px-4 py-3 border rounded-2xl"
                            required
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-2">Hora</label>

                        <input
                            type="time"
                            name="hora"
                            value="{{ old('hora', $evento->hora) }}"
                            class="w-full px-4 py-3 border rounded-2xl"
                            required
                        >
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">Descrição</label>

                    <textarea
                        name="descricao"
                        rows="5"
                        class="w-full px-4 py-3 border rounded-2xl"
                        required
                    >{{ old('descricao', $evento->descricao) }}</textarea>
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
