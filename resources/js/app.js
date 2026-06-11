// public/js/app.js

// Torna as funções globais para onclick funcionar
window.previousTip = previousTip;
window.nextTip = nextTip;
window.previousEvent = previousEvent;
window.nextEvent = nextEvent;
window.markOnMap = markOnMap;
window.scrollEvents = scrollEvents;

// Mobile Menu Toggle
const mobileBtn = document.getElementById('mobile-menu-button');
const mobileMenu = document.getElementById('mobile-menu');

if (mobileBtn && mobileMenu) {
    mobileBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
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
    if (map) map.remove();

    map = L.map('map', {
        zoomControl: true,
        scrollWheelZoom: true
    }).setView([-26.3044, -48.8487], 12);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors',
        maxZoom: 19,
    }).addTo(map);

    setTimeout(() => map.invalidateSize(), 800);
}

function loadMarkers() {
    fetch('/api/markers')
        .then(response => response.json())
        .then(data => data.forEach(marker => addMarker(marker)))
        .catch(err => console.error(err));
}

function addMarker(markerData) {
    const icons = { donation: '🟠', hospital: '🔵', event: '🔴' };
    const customIcon = L.divIcon({
        html: `<div style="font-size: 2.5rem;">${icons[markerData.type] || '🔵'}</div>`,
        iconSize: [50, 50],
        className: 'custom-marker'
    });

    L.marker([markerData.latitude, markerData.longitude], { icon: customIcon })
        .addTo(map)
        .bindPopup(`<div class="text-center"><strong>${markerData.title}</strong><br><small>${markerData.description}</small></div>`);
}

/* ==================== TIPS ==================== */
let allTips = [];
let filteredTips = [];
let currentTipIndex = 0;

function loadTips() {
    // Dados de fallback (para testes enquanto a API não existe)
    allTips = [
        { type: "dog", title: "Passeio Diário", description: "Leve seu cachorro para passear diariamente. Isso ajuda na saúde física e mental." },
        { type: "dog", title: "Vacinação", description: "Mantenha a carteira de vacinação atualizada. Consulte um veterinário regularmente." },
        { type: "dog", title: "Alimentação", description: "Ofereça ração de qualidade adequada à idade e porte do seu cão." },

        { type: "cat", title: "Caixa de Areia", description: "Mantenha a caixa de areia sempre limpa. Gatos são muito higiênicos." },
        { type: "cat", title: "Arranhador", description: "Disponibilize arranhadores adequados para evitar que ele arranhe móveis." },
        { type: "cat", title: "Brinquedos", description: "Ofereça brinquedos interativos para estimular o instinto de caça." }
    ];

    filterTips('dog'); //
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
let allEvents = [];
let currentEventIndex = 0;

function loadEvents() {
    fetch('/api/events')
        .then(res => res.json())
        .then(events => {
            allEvents = events;

            // Desktop
            const desktopContainer = document.getElementById('eventsContainer');
            desktopContainer.innerHTML = '';
            events.forEach(event => {
                desktopContainer.innerHTML += createEventCard(event);
            });

            // Mobile
            renderCurrentEvent();
        })
        .catch(err => console.error(err));
}

function createEventCard(event) {
    return `
        <div class="event-card">
            <img src="${event.image}" alt="${event.title}" class="img-fluid rounded mb-3 w-full" style="height: 180px; object-fit: cover;">
            <h6 class="fw-bold">${event.date}</h6>
            <button class="btn btn-success btn-sm mt-2 mb-3" onclick="markOnMap(${event.latitude || 0}, ${event.longitude || 0})">
                Marcar no mapa
            </button>
            <p class="mb-0">${event.description}</p>
        </div>
    `;
}

function renderCurrentEvent() {
    const container = document.getElementById('eventsContainerMobile');
    if (allEvents.length === 0) return;
    container.innerHTML = createEventCard(allEvents[currentEventIndex]);
}

function nextEvent() {
    if (allEvents.length === 0) return;
    currentEventIndex = (currentEventIndex + 1) % allEvents.length;
    renderCurrentEvent();
}

function previousEvent() {
    if (allEvents.length === 0) return;
    currentEventIndex = (currentEventIndex - 1 + allEvents.length) % allEvents.length;
    renderCurrentEvent();
}

function markOnMap(lat, lng) {
    if (map) map.flyTo([lat, lng], 15, { duration: 2 });
}

function scrollEvents(direction) {
    const container = document.getElementById('eventsContainer');
    const scrollAmount = 380;
    container.scrollBy({ left: direction === 'left' ? -scrollAmount : scrollAmount, behavior: 'smooth' });
}

/* ==================== INIT ==================== */
document.addEventListener('DOMContentLoaded', function() {
    initMap();
    loadTips();
    loadEvents();

    const petFilter = document.getElementById('petFilter');
    if (petFilter) {
        petFilter.addEventListener('change', () => filterTips(petFilter.value));
    }
});
