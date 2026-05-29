// resources/js/panorama.js
import '../css/panorama.css';
import { Viewer } from '@photo-sphere-viewer/core';
import '@photo-sphere-viewer/core/index.css';

const config = window.PANORAMA_CONFIG || {};

// ── Liste ordonnée des panoramas (depuis la config PHP) ──────────────────
const panoramas = config.gallery ?? [
    { file: config.panorama, title: config.title, location: config.location }
];

let currentIndex = 0;

const viewer = new Viewer({
    container: document.getElementById('panorama-viewer'),
    panorama: panoramas[0].file,
    defaultYaw: config.defaultYaw ?? 0,
    defaultPitch: config.defaultPitch ?? 0,
    defaultZoomLvl: 50,
    touchmoveTwoFingers: false,
    mousewheelCtrlKey: false,
    navbar: ['zoom', 'move', 'fullscreen'],
});

// ── Masquer le loader ────────────────────────────────────────────────────
viewer.addEventListener('ready', () => {
    document.getElementById('pano-loading')?.classList.add('hidden');
    updateArrow();
}, { once: true });

// ── Fonction de navigation vers un index ────────────────────────────────
function goTo(index) {
    if (index < 0 || index >= panoramas.length) return;

    document.getElementById('pano-loading')?.classList.remove('hidden');

    viewer.setPanorama(panoramas[index].file, {
        transition: true,
        speed: '3rpm',
    }).then(() => {
        currentIndex = index;
        document.getElementById('pano-loading')?.classList.add('hidden');

        // Mettre à jour le header
        document.querySelector('.pano-header__title').textContent    = panoramas[index].title    ?? '';
        document.querySelector('.pano-header__subtitle').textContent = panoramas[index].location ?? '';

        updateArrow();
    });
}

// ── Cacher la flèche sur le dernier panorama ─────────────────────────────
function updateArrow() {
    const btn = document.getElementById('btn-next-pano');
    if (!btn) return;
    btn.style.display = currentIndex >= panoramas.length - 1 ? 'none' : 'flex';
}

// ── Flèche suivant ───────────────────────────────────────────────────────
document.getElementById('btn-next-pano')?.addEventListener('click', () => {
    goTo(currentIndex + 1);
});

// ── Plein écran ──────────────────────────────────────────────────────────
document.getElementById('btn-fullscreen')?.addEventListener('click', () => {
    viewer.toggleFullscreen();
});

export default viewer;
