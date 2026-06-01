@extends('layouts.app')


    @section('content')
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Panorama 360° — {{ $photo['title'] ?? 'Vue panoramique' }}</title>
        @vite(['resources/js/panorama.js', 'resources/css/panorama.css'])
    </head>
    <body>

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
            <button class="btn-ctrl" id="btn-fullscreen" title="Plein écran">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/>
                </svg>
            </button>
        </div>
    </header>

    <div id="panorama-viewer">
        <div class="pano-loading" id="pano-loading">
            <div class="pano-loading__spinner"></div>
            <p>Chargement du panorama…</p>
        </div>
    </div>

    <script>
        window.PANORAMA_CONFIG = {
            defaultYaw:   {{ $photo['default_yaw']   ?? 0 }},
            defaultPitch: {{ $photo['default_pitch'] ?? 0 }},

            gallery: [
                    @foreach($gallery ?? [$photo] as $p)
                {
                    file:     "{{ asset($p['file']) }}",
                    title:    "{{ addslashes($p['title']) }}",
                    location: "{{ addslashes($p['location'] ?? '') }}",
                    markers:  {!! json_encode(array_map(fn($m) => [
                        'id'          => $m['id'],
                        'yaw'         => (float) $m['yaw'],
                        'pitch'       => (float) $m['pitch'],
                        'rotation'    => (float) ($m['rotation'] ?? 0), // <-- TRANSFIÈRE LA ROTATION ICI
                        'label'       => $m['label']       ?? '',
                        'description' => $m['description'] ?? '',
                        'target'      => $m['target']      ?? null,
                    ], $p['markers'] ?? []), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT) !!},
                },
                @endforeach
            ],
        };
    </script>

    </body>
@endsection
