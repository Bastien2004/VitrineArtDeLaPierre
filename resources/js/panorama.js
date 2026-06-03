import '../css/panorama.css';
import { Viewer }             from '@photo-sphere-viewer/core';
import { MarkersPlugin }      from '@photo-sphere-viewer/markers-plugin';
import { VisibleRangePlugin } from '@photo-sphere-viewer/visible-range-plugin';
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
    let visibleRangePlugin;

    function buildVisibleRange(pano) {
        return {
            verticalRange: [
                pano.min_pitch !== null && pano.min_pitch !== undefined ? pano.min_pitch : -Math.PI / 2,
                pano.max_pitch !== null && pano.max_pitch !== undefined ? pano.max_pitch :  Math.PI / 2,
            ],
            horizontalRange:
                pano.min_yaw !== null && pano.min_yaw !== undefined &&
                pano.max_yaw !== null && pano.max_yaw !== undefined
                    ? [pano.min_yaw, pano.max_yaw]
                    : [-Math.PI, Math.PI],
        };
    }

    const initialRange = buildVisibleRange(panoramas[0]);

    try {
        viewer = new Viewer({
            container:           document.getElementById('panorama-viewer'),
            panorama:            panoramas[0].file,
            defaultYaw:          panoramas[0].default_yaw   ?? 0,
            defaultPitch:        panoramas[0].default_pitch ?? 0,
            defaultZoomLvl:      50,
            touchmoveTwoFingers: false,
            mousewheelCtrlKey:   false,
            navbar:              ['zoom', 'move', 'fullscreen'],
            plugins: [
                [MarkersPlugin, { markers: buildMarkers(0) }],
                [VisibleRangePlugin, {
                    verticalRange:   initialRange.verticalRange,
                    horizontalRange: initialRange.horizontalRange,
                    usePanoData:     false,
                }],
            ],
        });

        markersPlugin      = viewer.getPlugin(MarkersPlugin);
        visibleRangePlugin = viewer.getPlugin(VisibleRangePlugin);
    } catch (e) {
        console.warn("[Panorama] Erreur lors de l'initialisation du viewer:", e);
        document.getElementById('pano-loading')?.classList.add('hidden');
    }

    if (!viewer || !markersPlugin) return;


    function buildMarkers(target) {
        const pano = typeof target === 'number' ? panoramas[target] : target;
        if (!pano) return [];

        const markers = pano.markers ?? [];

        const arrowSvgString = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="60" height="60">
            <circle cx="24" cy="24" r="22" fill="rgba(0,0,0,0.5)" stroke="white" stroke-width="2"/>
            <path d="M24 10 L34 22 L27 22 L27 34 L21 34 L21 22 L14 22 Z" fill="white" />
        </svg>`;
        const arrowImageUrl = 'data:image/svg+xml;base64,' + btoa(arrowSvgString);

        return markers.map(m => {
            const isNav = m.target !== null && m.target !== undefined;

            if (isNav) {
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
                           </div>`,
                };
            }
        });
    }

    viewer.addEventListener('ready', () => {
        document.getElementById('pano-loading')?.classList.add('hidden');
        updateNavArrow();
    }, { once: true });

    function applyRanges(pano) {
        const hasVertical   = pano.min_pitch !== null && pano.min_pitch !== undefined
            && pano.max_pitch !== null && pano.max_pitch !== undefined;
        const hasHorizontal = pano.min_yaw   !== null && pano.min_yaw   !== undefined
            && pano.max_yaw   !== null && pano.max_yaw   !== undefined;

        visibleRangePlugin.setVerticalRange(
            hasVertical ? [pano.min_pitch, pano.max_pitch] : null
        );
        visibleRangePlugin.setHorizontalRange(
            hasHorizontal ? [pano.min_yaw, pano.max_yaw] : null
        );
    }

    function goTo(target) {
        const nextPano = typeof target === 'number'
            ? panoramas[target]
            : panoramas.find(p => p.id === target);

        if (!nextPano) return;

        const index = panoramas.indexOf(nextPano);
        document.getElementById('pano-loading')?.classList.remove('hidden');

        // ✅ setTimeout(0) : on s'exécute après TOUS les handlers synchrones
        // de PanoramaLoadedEvent, dont le __moveToRange() interne du plugin
        viewer.addEventListener('panorama-loaded', () => {
            setTimeout(() => applyRanges(nextPano), 0);
        }, { once: true });

        viewer.setPanorama(nextPano.file, {
            transition: true,
            speed:      '3rpm',
            position: {
                yaw:   nextPano.default_yaw   ?? 0,
                pitch: nextPano.default_pitch ?? 0,
            },
        })
            .then(() => {
                currentIndex = index;
                document.getElementById('pano-loading')?.classList.add('hidden');

                const titleEl    = document.querySelector('.pano-header__title');
                const subtitleEl = document.querySelector('.pano-header__subtitle');
                if (titleEl)    titleEl.textContent    = nextPano.title    ?? '';
                if (subtitleEl) subtitleEl.textContent = nextPano.location ?? '';

                markersPlugin.clearMarkers();
                buildMarkers(nextPano).forEach(m => markersPlugin.addMarker(m));

                updateNavArrow();
            })
            .catch((err) => {
                console.warn("[Panorama] Erreur de transition :", err);
                document.getElementById('pano-loading')?.classList.add('hidden');
            });
    }

    markersPlugin.addEventListener('select-marker', ({ marker }) => {
        if (marker.id === 'fleche-de-test-dev') return;

        const data = (panoramas[currentIndex]?.markers ?? []).find(m => m.id === marker.id);
        if (data?.target !== null && data?.target !== undefined) {
            goTo(data.target);
        }
    });

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

    viewer.addEventListener('click', ({ data }) => {
        const yaw   = data.yaw.toFixed(4);
        const pitch = data.pitch.toFixed(4);

        console.log(`%c 📍 Coordonnées pour votre PanoramaController :`, 'background: #1c1a17; color: #dfb76c; padding: 4px; font-weight: bold;');
        console.log(`'yaw'   => ${yaw},\n'pitch' => ${pitch},`);

        const devMarkerId       = 'fleche-de-test-dev';
        const testArrowSvg      = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="60" height="60"><circle cx="24" cy="24" r="22" fill="rgba(223, 183, 108, 0.8)" stroke="white" stroke-width="2"/><path d="M24 10 L34 22 L27 22 L27 34 L21 34 L21 22 L14 22 Z" fill="white" /></svg>`;
        const testArrowImageUrl = 'data:image/svg+xml;base64,' + btoa(testArrowSvg);

        if (markersPlugin.getMarker(devMarkerId)) {
            markersPlugin.updateMarker({
                id:       devMarkerId,
                position: { yaw: data.yaw, pitch: data.pitch },
            });
        } else {
            markersPlugin.addMarker({
                id:          devMarkerId,
                position:    { yaw: data.yaw, pitch: data.pitch },
                image:       testArrowImageUrl,
                size:        { width: 60, height: 60 },
                orientation: 'horizontal',
                tooltip:     'Position de test',
            });
        }
    });
});
