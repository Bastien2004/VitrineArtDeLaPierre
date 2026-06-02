@extends('layouts.app')

@section('title', ($photo['title'] ?? 'Vue panoramique') . ' — Panorama 360°')

@push('styles')
    @vite(['resources/js/panorama.js', 'resources/css/panorama.css'])
@endpush


@section('content')

    <div class="pano-header">
        <div class="pano-header__controls">
            <button class="btn-ctrl" id="btn-fullscreen" title="Plein écran">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"/>
                </svg>
            </button>
        </div>
    </div>

    <div id="panorama-viewer">
        <div class="pano-loading" id="pano-loading">
            <div class="pano-loading__spinner"></div>
            <p>Chargement du panorama…</p>
        </div>
    </div>

    @push('scripts')
        <script>
            window.PANORAMA_CONFIG = {
                defaultYaw:   {{ $photo['default_yaw']   ?? 0 }},
                defaultPitch: {{ $photo['default_pitch'] ?? 0 }},
                gallery: {!! json_encode(array_map(fn($p) => [
            'file'      => asset($p['file']),
            'title'     => $p['title']    ?? '',
            'location'  => $p['location'] ?? '',
            'min_pitch' => isset($p['min_pitch']) ? (float) $p['min_pitch'] : null,
            'max_pitch' => isset($p['max_pitch']) ? (float) $p['max_pitch'] : null,
            'min_yaw'   => isset($p['min_yaw'])   ? (float) $p['min_yaw']   : null,
            'max_yaw'   => isset($p['max_yaw'])   ? (float) $p['max_yaw']   : null,
            'markers'   => array_map(fn($m) => [
                'id'          => $m['id'],
                'yaw'         => (float) $m['yaw'],
                'pitch'       => (float) $m['pitch'],
                'rotation'    => (float) ($m['rotation'] ?? 0),
                'label'       => $m['label']       ?? '',
                'description' => $m['description'] ?? '',
                'target'      => $m['target']      ?? null,
            ], $p['markers'] ?? []),
        ], $gallery ?? [$photo]), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT) !!},
            };
        </script>
    @endpush

@endsection
