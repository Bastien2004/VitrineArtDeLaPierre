@extends('layouts.app')

@section('title', ($photo['title'] ?? 'Vue panoramique') . ' — Panorama 360°')

@push('styles')
    @vite(['resources/js/panorama.js', 'resources/css/panorama.css'])
@endpush

@section('content')

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
                    'rotation'    => (float) ($m['rotation'] ?? 0),
                    'label'       => $m['label']       ?? '',
                    'description' => $m['description'] ?? '',
                    'target'      => $m['target']      ?? null,
                ], $p['markers'] ?? []), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT) !!},
                    },
                    @endforeach
                ],
            };
        </script>
    @endpush

@endsection
