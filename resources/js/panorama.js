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
        document.getElementById('pano-loading')?.classList.add('hidden');
    }

    if (!viewer || !markersPlugin) return;

    // ── Construire les markers d'un panorama ──────────────────────────────────
    function buildMarkers(index) {
        if (!panoramas[index]) return [];
        const markers = panoramas[index].markers ?? [];

        const arrowSvgString = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="60" height="60">
            <circle cx="24" cy="24" r="22" fill="rgba(0,0,0,0.5)" stroke="white" stroke-width="2"/>
            <path d="M24 10 L34 22 L27 22 L27 34 L21 34 L21 22 L14 22 Z" fill="white" />
        </svg>`;
        const arrowImageUrl = 'data:image/svg+xml;base64,' + btoa(arrowSvgString);

        return markers.map(m => {
            const isNav = m.target !== null && m.target !== undefined;

            if (isNav) {
                // CORRECTION V5 : Utilisation de 'image' combiné à 'orientation' pour fixer au sol
                return {
                    id:          m.id,
                    position:    { yaw: m.yaw, pitch: m.pitch },
                    tooltip:     m.label || null,
                    image:       arrowImageUrl,
                    size:        { width: 60, height: 60 },
                    orientation: 'horizontal',
                    rotation:    m.rotation ?? 0,
                };
            } else {
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

                const titleEl    = document.querySelector('.pano-header__title');
                const subtitleEl = document.querySelector('.pano-header__subtitle');
                if (titleEl)    titleEl.textContent    = panoramas[index].title    ?? '';
                if (subtitleEl) subtitleEl.textContent = panoramas[index].location ?? '';

                markersPlugin.clearMarkers();
                buildMarkers(index).forEach(m => markersPlugin.addMarker(m));

                updateNavArrow();
            })
            .catch((err) => {
                console.warn("[Panorama] Erreur de transition :", err);
                document.getElementById('pano-loading')?.classList.add('hidden');
            });
    }

    // ── Clic sur un marker ────────────────────────────────────────────────────
    markersPlugin.addEventListener('select-marker', ({ marker }) => {
        // Ignorer le clic si c'est la flèche temporaire de développement
        if (marker.id === 'fleche-de-test-dev') return;

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

    // ── OUTIL DE DÉVELOPPEMENT : CLIC, LOGS ET PLACEMENT DE FLÈCHE ───────────
    viewer.addEventListener('click', ({ data }) => {
        const yaw = data.yaw.toFixed(4);
        const pitch = data.pitch.toFixed(4);

        // 1. Log propre directement copiable dans votre PanoramaController.php
        console.log(`%c 📍 Coordonnées pour votre PanoramaController :`, 'background: #1c1a17; color: #dfb76c; padding: 4px; font-weight: bold;');
        console.log(`'yaw'   => ${yaw},\n'pitch' => ${pitch},`);

        // 2. Déplacement ou création visuelle de la flèche à l'endroit cliqué
        const devMarkerId = 'fleche-de-test-dev';

        // Flèche couleur Dorée (#dfb76c) pour bien la différencier de vos vraies flèches blanches
        const testArrowSvg = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="60" height="60"><circle cx="24" cy="24" r="22" fill="rgba(223, 183, 108, 0.8)" stroke="white" stroke-width="2"/><path d="M24 10 L34 22 L27 22 L27 34 L21 34 L21 22 L14 22 Z" fill="white" /></svg> `;
        const testArrowImageUrl = 'data:image/svg+xml;base64,' + btoa(testArrowSvg);

        if (markersPlugin.getMarker(devMarkerId)) {
            // Déplace la flèche existante au clic
            markersPlugin.updateMarker({
                id: devMarkerId,
                position: { yaw: data.yaw, pitch: data.pitch }
            });
        } else {
            // Crée la flèche au tout premier clic
            markersPlugin.addMarker({
                id:          devMarkerId,
                position:    { yaw: data.yaw, pitch: data.pitch },
                image:       testArrowImageUrl,
                size:        { width: 60, height: 60 },
                orientation: 'horizontal', // Couchée à plat au sol
                tooltip:     'Position de test',
            });
        }
    });
});
