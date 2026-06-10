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

    function updateVideo(pano) {
        const videoContainer = document.getElementById('pano-video-container');
        const videoPlayer = document.getElementById('video-player');
        const videoTitle = document.getElementById('video-title');
        const panoramaViewer = document.getElementById('panorama-viewer');

        if (!pano.video_id) {
            // Pas de vidéo pour ce panorama
            videoContainer.classList.remove('visible');
            panoramaViewer.style.height = '100vh'; // ✅ 100vh quand pas de vidéo
            return;
        }

        // Afficher le conteneur
        videoContainer.classList.add('visible');
        panoramaViewer.style.height = '50vh'; // ✅ 50vh quand vidéo visible
        videoTitle.textContent = pano.video_title || 'Vidéo';

        // Créer l'iframe YouTube
        const iframe = document.createElement('iframe');
        iframe.src = `https://www.youtube.com/embed/${pano.video_id}`;
        iframe.frameborder = '0';
        iframe.allow = 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share';
        iframe.allowFullscreen = true;
        iframe.className = 'video-iframe';

        // Effacer l'ancien contenu et ajouter le nouvel iframe
        videoPlayer.innerHTML = '';
        videoPlayer.appendChild(iframe);
    }

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
                const el = document.createElement('div');
                el.className = 'pano-label';
                el.innerHTML = (m.label ? `<span class="pano-label__text">${m.label}</span>` : '') + '<span class="pano-label__dot"></span>';
                return {
                    id:       m.id,
                    position: { yaw: m.yaw, pitch: m.pitch },
                    anchor:   'bottom center',
                    element:  el,
                };
            }
        });
    }

    viewer.addEventListener('ready', () => {
        document.getElementById('pano-loading')?.classList.add('hidden');
        updateNavArrow();
        updateVideo(panoramas[0]);
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

                updateVideo(nextPano);

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

    document.getElementById('btn-close-video')?.addEventListener('click', () => {
        document.getElementById('pano-video-container').classList.remove('visible');
        document.getElementById('panorama-viewer').style.height = '100vh'; // ✅ Revenir à 100vh
    });

    document.getElementById('btn-next-pano')?.addEventListener('click', () => {
        goTo(currentIndex + 1);
    });

    document.getElementById('btn-autorotate')?.addEventListener('click', () => {
        viewer.toggleAutorotate?.();
    });

    document.getElementById('btn-fullscreen')?.addEventListener('click', () => {
        viewer.toggleFullscreen();
    });
});
