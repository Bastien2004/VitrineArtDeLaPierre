<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panorama 360° — {{ $photo['title'] ?? 'Vue panoramique' }}</title>
    @vite(['resources/js/panorama.js', 'resources/css/panorama.css'])
</head>
<body>

{{-- Header flottant --}}
<header class="pano-header">
    <div class="pano-header__logo">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <circle cx="12" cy="12" r="10"/>
            <path d="M2 12h20M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
        </svg>
    </div>
    <div class="pano-header__info">
        <h1 class="pano-header__title">{{ $photo['title'] ?? 'Panorama 360°' }}</h1>
        <p class="pano-header__subtitle">{{ $photo['location'] ?? '' }}</p>
    </div>
    <div class="pano-header__controls">
        <button class="btn-ctrl" id="btn-autorotate" title="Auto-rotation">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M21 12a9 9 0 1 1-9-9"/>
                <path d="M21 3v9h-9"/>
            </svg>
        </button>
        <button class="btn-ctrl" id="btn-fullscreen" title="Plein écran">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/>
            </svg>
        </button>
    </div>
</header>

{{-- Conteneur du viewer --}}
<div id="panorama-viewer" style="position: relative;">
    <div class="pano-loading" id="pano-loading">
        <div class="pano-loading__spinner"></div>
        <p>Chargement du panorama…</p>
    </div>

    {{-- FLÈCHE FIXE : Elle reste au centre en bas, sans bouger avec la 3D --}}
    <button id="btn-next-pano" class="nav-arrow-fixed" title="Passer au panorama suivant">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="19" x2="12" y2="5"></line>
            <polyline points="5 12 12 5 19 12"></polyline>
        </svg>
    </button>
</div>

{{-- Données PHP → JS --}}
<script>
    window.PANORAMA_CONFIG = {
        panorama: "{{ asset($photo['file']) }}",
        title:    "{{ $photo['title'] ?? '' }}",
        location: "{{ $photo['location'] ?? '' }}",
        caption:  "{{ $photo['caption'] ?? '' }}",
        defaultYaw:   {{ $photo['default_yaw'] ?? 0 }},
        defaultPitch: {{ $photo['default_pitch'] ?? 0 }},
        gallery: [
                @foreach($gallery ?? [$photo] as $p)
            {
                file:     "{{ asset($p['file']) }}",
                title:    "{{ $p['title'] }}",
                location: "{{ $p['location'] ?? '' }}",
            },
            @endforeach
        ],
    };
</script>

</body>
</html>
