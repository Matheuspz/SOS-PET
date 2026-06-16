@extends('layouts.app')

@section('title', 'Eventos - SOS PET')

@section('content')
    @include('layouts.navbar')

    <!-- Hero Events -->
    <section class="hero-section py-16" style="background: linear-gradient(to bottom, #59e0d4, #dceb45);">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl md:text-6xl font-black mb-6 text-black">
                Eventos
            </h1>

            <p class="text-xl max-w-2xl mx-auto text-black/90">
                Fique por dentro de todas as nossas feirinhas de adoção,
                campanhas e eventos beneficentes
            </p>
        </div>
    </section>

    <!-- Events Content -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">

            <div class="space-y-8">

                @forelse($eventos as $evento)

                    <div class="bg-white rounded-3xl shadow-lg overflow-hidden">

                        <div class="p-8">

                            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

                                <div>
                                    <h2 class="text-3xl font-bold text-gray-900">
                                        {{ $evento->titulo }}
                                    </h2>
                                </div>

                                <div class="text-left md:text-right">
                                    <div class="font-bold text-lg text-[#72AE1D]">
                                        {{ \Carbon\Carbon::parse($evento->data)->format('d/m/Y') }}
                                    </div>

                                    <div class="text-gray-600">
                                        {{ $evento->hora }}
                                    </div>
                                </div>

                            </div>

                            <div class="border-t pt-6">
                                <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                                    {{ $evento->descricao }}
                                </p>
                            </div>

                        </div>

                    </div>

                @empty

                    <div class="bg-white rounded-3xl shadow-lg p-12 text-center">
                        <i class="bi bi-calendar-event text-6xl text-gray-300"></i>

                        <h3 class="text-2xl font-bold mt-4 mb-2">
                            Nenhum evento cadastrado
                        </h3>

                        <p class="text-gray-600">
                            Em breve novos eventos serão divulgados.
                        </p>
                    </div>

                @endforelse

            </div>

        </div>
    </section>

    @include('layouts.footer')
@endsection
