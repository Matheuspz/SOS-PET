// public/js/app.js

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

    loadMarkers();   // ← Carrega os marcadores do banco
}

function loadMarkers() {
    fetch('/api/marcadores')
        .then(response => response.json())
        .then(data => {
            if (data.type === 'FeatureCollection') {
                data.features.forEach(feature => {
                    addColoredMarker(feature);
                });
            }
        })
        .catch(err => console.error('Erro ao carregar marcadores:', err));
}

function addColoredMarker(feature) {
    const props = feature.properties;
    const coords = feature.geometry.coordinates; // [lng, lat]

    // Cor do pin
    const color = props.cor || '#6B7280';

    // Criar ícone colorido simples
    const coloredIcon = L.divIcon({
        className: 'custom-pin',
        html: `
            <div style="
                background-color: ${color};
                width: 28px;
                height: 28px;
                border-radius: 50% 50% 50% 0;
                border: 3px solid white;
                box-shadow: 0 3px 8px rgba(0,0,0,0.4);
                transform: rotate(-45deg);
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 14px;
            ">
            </div>
        `,
        iconSize: [28, 38],
        iconAnchor: [14, 38],
        popupAnchor: [0, -35]
    });

    L.marker([coords[1], coords[0]], { icon: coloredIcon })
        .addTo(map)
        .bindPopup(`
            <strong style="color: ${color}">${props.label || props.title}</strong><br>
            ${props.description || ''}
        `);
}

/* ==================== TIPS CAROUSEL + FILTRO ==================== */
let currentTip = 0;
let visibleSlides = [];

function initTipsCarousel() {
    const allSlides = document.querySelectorAll('.tip-slide');
    if (allSlides.length === 0) return;

    window.showTip = function(index) {
        visibleSlides.forEach((slide, i) => {
            slide.style.opacity = (i === index) ? '1' : '0';
            slide.style.pointerEvents = (i === index) ? 'auto' : 'none';
        });
        currentTip = index;
        updateIndicators();
    };

    window.nextTip = function() {
        if (visibleSlides.length === 0) return;
        let next = (currentTip + 1) % visibleSlides.length;
        showTip(next);
    };

    window.prevTip = function() {
        if (visibleSlides.length === 0) return;
        let prev = (currentTip - 1 + visibleSlides.length) % visibleSlides.length;
        showTip(prev);
    };

    window.goToTip = function(index) {
        showTip(index);
    };

    // Inicializa mostrando todas
    filterTips('all');
}

function filterTips(tipo) {
    const allSlides = document.querySelectorAll('.tip-slide');
    visibleSlides = [];

    allSlides.forEach(slide => {
        if (tipo === 'all' || slide.dataset.tipo === tipo) {
            slide.style.display = 'flex';
            visibleSlides.push(slide);
        } else {
            slide.style.display = 'none';
        }
    });

    // Recria os indicadores
    createIndicators();

    // Mostra o primeiro card do filtro
    if (visibleSlides.length > 0) {
        currentTip = 0;
        showTip(0);
    }
}

function createIndicators() {
    const container = document.getElementById('tip-indicators');
    if (!container) return;

    container.innerHTML = '';

    visibleSlides.forEach((_, index) => {
        const btn = document.createElement('button');
        btn.className = `w-4 h-4 rounded-full transition-all ${index === 0 ? 'bg-[#72AE1D] scale-125' : 'bg-gray-300'}`;
        btn.onclick = () => goToTip(index);
        container.appendChild(btn);
    });
}

function updateIndicators() {
    const indicators = document.querySelectorAll('#tip-indicators button');
    indicators.forEach((ind, i) => {
        ind.classList.toggle('bg-[#72AE1D]', i === currentTip);
        ind.classList.toggle('bg-gray-300', i !== currentTip);
        ind.classList.toggle('scale-125', i === currentTip);
    });
}

/* ==================== INIT ==================== */
document.addEventListener('DOMContentLoaded', function() {
    initMap();
    loadMarkers();

    initTipsCarousel();   // Inicializa carrossel + filtro

    const petFilter = document.getElementById('petFilter');
    if (petFilter) {
        petFilter.addEventListener('change', () => filterTips(petFilter.value));
    }
});
