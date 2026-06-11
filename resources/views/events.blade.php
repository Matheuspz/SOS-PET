@extends('layouts.app')

@section('title', 'Evento - SOS PET')

@section('content')
    @include('layouts.navbar')

    <!-- Hero Events -->
    <section class="hero-section py-16" style="background: linear-gradient(to bottom, #59e0d4, #dceb45);">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl md:text-6xl font-black mb-6 text-black">Eventos</h1>
            <p class="text-xl max-w-2xl mx-auto text-black/90">
                Fique por dentro de todas as nossas feirinhas de adoção, campanhas e eventos beneficentes
            </p>
        </div>
    </section>

    <!-- Events Content -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">

            <div id="eventsList" class="space-y-16">
                <!-- Populado via JS -->
            </div>
        </div>
    </section>

    @include('layouts.footer')
@endsection

@section('scripts')
    <script>
        function loadEventsPage() {
            fetch('/api/events')
                .then(res => res.json())
                .then(events => {
                    const container = document.getElementById('eventsList');
                    container.innerHTML = '';

                    events.forEach(event => {
                        const card = document.createElement('div');
                        card.className = 'event-card bg-white rounded-3xl overflow-hidden shadow-xl';
                        card.innerHTML = `
                            <div class="grid md:grid-cols-2 gap-0">
                                <!-- Imagem -->
                                <div>
                                    <img src="${event.image}"
                                         class="w-full h-full md:h-[460px] object-cover"
                                         alt="${event.title || 'Evento'}">
                                </div>

                                <!-- Informações -->
                                <div class="p-8 md:p-12 flex flex-col">
                                    <h5 class="font-bold text-2xl">${event.date}</h5>
                                    <h4 class="text-3xl font-bold mt-3 mb-6">${event.title || 'Evento Especial'}</h4>

                                    <!-- Link "Mais Informações" - Apenas no celular -->
                                    <a onclick="toggleDescription(this)"
                                       class="md:hidden text-black font-medium cursor-pointer mt-4 inline-block underline underline-offset-4 hover:underline-offset-8 transition-all">
                                        Mais Informações
                                    </a>

                                    <!-- Descrição - escondida no mobile por padrão -->
                                    <p class="text-gray-800 leading-relaxed flex-1 md:line-clamp-none hidden md:block mt-4">
                                        ${event.description}
                                    </p>
                                </div>
                            </div>
                        `;
                        container.appendChild(card);
                    });
                })
                .catch(err => console.error('Erro ao carregar eventos:', err));
        }

        // Toggle descrição apenas no mobile
        window.toggleDescription = function(link) {
            const card = link.closest('.event-card');
            const description = card.querySelector('p');

            if (description.classList.contains('hidden')) {
                description.classList.remove('hidden');
                link.textContent = 'Mostrar menos';
            } else {
                description.classList.add('hidden');
                link.textContent = 'Mais Informações';
            }
        }

        document.addEventListener('DOMContentLoaded', loadEventsPage);
    </script>
@endsection
