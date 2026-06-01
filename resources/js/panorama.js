import '../css/panorama.css';
import { Viewer }        from '@photo-sphere-viewer/core';
import { MarkersPlugin } from '@photo-sphere-viewer/markers-plugin';
import '@photo-sphere-viewer/core/index.css';
import '@photo-sphere-viewer/markers-plugin/index.css';

document.addEventListener('DOMContentLoaded', () => {
    const config    = window.PANORAMA_CONFIG || {};
    const panoramas = config.gallery ?? [];

    if (!panoramas.length || !panoramas[0]) {
        console.error('[Panorama] Aucun panorama valide trouvé dans la configuration.');
        return;
    }

    let currentIndex = 0;
    let viewer;
    let markersPlugin;

    try {
        // Init le Viewer
        viewer = new Viewer({
            container:           document.getElementById('panorama-viewer'),
            panorama:            panoramas[0].file,
            defaultYaw:          config.defaultYaw   ?? 0,
            defaultPitch:        config.defaultPitch ?? 0,
            defaultZoomLvl:      50,
            touchmoveTwoFingers: false,
            mousewheelCtrlKey:   false,
            navbar:              ['zoom', 'move', 'fullscreen'],
            plugins: [
                [MarkersPlugin, { markers: buildMarkers(0) }],
            ],
        });

        markersPlugin = viewer.getPlugin(MarkersPlugin);
    } catch (e) {
        console.warn("[Panorama] Erreur lors de l'initialisation du viewer:", e);
        // On force quand même la disparition de l'écran de chargement si le viewer a réussi à s'ouvrir
        document.getElementById('pano-loading')?.classList.add('hidden');
    }

    // Sécurité si l'initialisation a complètement échoué
    if (!viewer || !markersPlugin) return;

    // ── Construire les markers d'un panorama ──────────────────────────────────
    function buildMarkers(index) {
        if (!panoramas[index]) return [];
        const markers = panoramas[index].markers ?? [];

        // Flèche SVG blanche avec un fond sombre circulaire
        const arrowSvgString = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="60" height="60">
        <circle cx="24" cy="24" r="22" fill="rgba(0,0,0,0.5)" stroke="white" stroke-width="2"/>
        <path d="M24 10 L34 22 L27 22 L27 34 L21 34 L21 22 L14 22 Z" fill="white" />
    </svg>`;
        const arrowImageUrl = 'data:image/svg+xml;base64,' + btoa(arrowSvgString);

        return markers.map(m => {
            const isNav = m.target !== null && m.target !== undefined;

            if (isNav) {
                // LA SOLUTION : imageLayer crée un maillage 3D fixe au sol
                return {
                    id:          m.id,
                    position:    { yaw: m.yaw, pitch: m.pitch },
                    tooltip:     m.label || null,
                    imageLayer:  arrowImageUrl,           // <-- CHANGE ICI (Fige le marqueur dans l'espace)
                    size:        { width: 50, height: 50 }, // <-- Format de taille requis pour la v5
                    orientation: 'horizontal',            // Couche le marqueur à plat sur le sol
                    rotation:    m.rotation ?? 0,         // Tourne la flèche sur elle-même vers sa cible
                };
            } else {
                // Marqueur info classique 2D (📍) qui reste face caméra
                return {
                    id:       m.id,
                    position: { yaw: m.yaw, pitch: m.pitch },
                    tooltip:  m.label || null,
                    anchor:   'bottom center',
                    html: `<div class="psv-marker-arrow">
                           ${m.label ? `<span class="psv-marker-arrow__label">${m.label}</span>` : ''}
                           <span class="psv-marker-arrow__icon">📍</span>
                       </div>`
                };
            }
        });
    }

    // ── Ready ─────────────────────────────────────────────────────────────────
    viewer.addEventListener('ready', () => {
        document.getElementById('pano-loading')?.classList.add('hidden');
        updateNavArrow();
    }, { once: true });

    // ── Navigation vers un index ──────────────────────────────────────────────
    function goTo(index) {
        if (index < 0 || index >= panoramas.length) return;

        document.getElementById('pano-loading')?.classList.remove('hidden');

        viewer.setPanorama(panoramas[index].file, {
            transition: true,
            speed: '3rpm',
        })
            .then(() => {
                currentIndex = index;
                document.getElementById('pano-loading')?.classList.add('hidden');

                document.querySelector('.pano-header__title').textContent    = panoramas[index].title    ?? '';
                document.querySelector('.pano-header__subtitle').textContent = panoramas[index].location ?? '';

                markersPlugin.clearMarkers();
                buildMarkers(index).forEach(m => markersPlugin.addMarker(m));

                updateNavArrow();
            })
            .catch((err) => {
                // C'EST ICI : On intercepte l'erreur de l'extension pour éviter le freeze
                console.warn("[Panorama] Erreur de transition (souvent liée à une extension) :", err);
                document.getElementById('pano-loading')?.classList.add('hidden');
            });
    }

    // ── Clic sur un marker ────────────────────────────────────────────────────
    markersPlugin.addEventListener('select-marker', ({ marker }) => {
        const data = (panoramas[currentIndex]?.markers ?? []).find(m => m.id === marker.id);
        if (data?.target !== null && data?.target !== undefined) {
            goTo(data.target);
        }
    });

    // ── Flèche fixe (panorama suivant) ───────────────────────────────────────
    function updateNavArrow() {
        const btn = document.getElementById('btn-next-pano');
        if (!btn) return;
        btn.style.display = currentIndex >= panoramas.length - 1 ? 'none' : 'flex';
    }

    document.getElementById('btn-next-pano')?.addEventListener('click', () => {
        goTo(currentIndex + 1);
    });

    document.getElementById('btn-autorotate')?.addEventListener('click', () => {
        viewer.toggleAutorotate?.();
    });

    document.getElementById('btn-fullscreen')?.addEventListener('click', () => {
        viewer.toggleFullscreen();
    });

    if (import.meta.env?.DEV) {
        viewer.addEventListener('click', ({ data }) => {
            console.log(
                `%c[Marker coords]%c yaw: ${data.yaw.toFixed(4)}  pitch: ${data.pitch.toFixed(4)}`,
                'color:#f59e0b;font-weight:bold', 'color:inherit'
            );
        });
    }
});
