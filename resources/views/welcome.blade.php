@extends('layouts.app')
@use('Illuminate\Support\Facades\Storage')

@section('content')

    <header class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content"></div>
        <img class="hero-wave" src="{{ asset('images/vague.svg') }}" alt="">
    </header>

    <main>

        {{-- ── BIOGRAPHIE ── --}}
        <section class="about-section">
            <div class="about-container">
                <div class="about-text-column">
                    <span class="section-label">L'artisan & L'artiste</span>
                    <h2 class="about-title">Mon histoire, <em>l'Art de la Pierre</em></h2>
                    <div class="section-rule-left"></div>
                    <div class="about-content">
                        <p class="about-lead">C'est à l'âge de 15 ans que je me suis laissé guider par ma passion : l'Art de la pierre.</p>
                        <p>Apprenti, j'ai eu l'opportunité d'être formé par un artiste-sculpteur tel que <strong>Charles Poitoux</strong> au sein de la marbrerie Vital-Evrard à Bellignies. La collaboration avec ce créateur m'a fourni les clés pour trouver ma propre voie...</p>
                        <p>À la fin de mes études aux Beaux-Arts de Montpellier en 1995, j'ai pris mon envol en créant mon entreprise à Bellignies, pays de la pierre bleue et du marbre.</p>
                        <p class="about-quote">Depuis maintenant plus de 20 ans, je transforme la matière brute et prends plaisir à la "faire vivre" en un mouvement subtil, une forme élégante qui traverse le temps, reflétant une histoire unique.</p>
                    </div>
                </div>
                <div class="about-image-column">
                    <div class="about-image-wrapper">
                        <div class="about-image-bg"></div>
                        <div class="about-img" style="background-image: url('{{ asset('images/artiste.jpg') }}');"></div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ── RÉALISATIONS ── --}}
        <section class="slider-section realisations" x-data="{}">

            {{-- En-tête --}}
            <div class="slider-section-header">
                <div class="slider-section-title-block">
                    <h2 class="slider-section-title">Nos réalisations</h2>
                    <div class="slider-section-rule"></div>
                </div>
                <div class="slider-section-arrows">
                    <button
                        class="slider-arrow"
                        @click="$refs.realisationsTrack.scrollBy({left: -360, behavior: 'smooth'})"
                        aria-label="Précédent">
                        ←
                    </button>
                    <button
                        class="slider-arrow"
                        @click="$refs.realisationsTrack.scrollBy({left: 360, behavior: 'smooth'})"
                        aria-label="Suivant">
                        →
                    </button>
                </div>
            </div>

            {{-- Track --}}
            <div class="slider-track" x-ref="realisationsTrack">
                @forelse($realisations as $realisation)
                    <div class="slider-card">
                        <img src="{{ Storage::url($realisation->image) }}"
                             alt="{{ $realisation->title }}"
                             class="slider-card-img">
                        <div class="slider-card-overlay">
                            <p class="slider-card-title">{{ $realisation->title }}</p>
                            @if($realisation->category)
                                <span class="slider-card-cat">{{ $realisation->category }}</span>
                            @endif
                        </div>
                    </div>
                @empty
                @endforelse
            </div>

        </section>

        {{-- ── RÉNOVATIONS ── --}}
        <section class="slider-section renovations" x-data="{}">

            {{-- En-tête --}}
            <div class="slider-section-header">
                <div class="slider-section-title-block">
                    <h2 class="slider-section-title">Nos rénovations</h2>
                    <div class="slider-section-rule"></div>
                </div>
                <div class="slider-section-arrows">
                    <button
                        class="slider-arrow"
                        @click="$refs.renovationsTrack.scrollBy({left: -360, behavior: 'smooth'})"
                        aria-label="Précédent">
                        ←
                    </button>
                    <button
                        class="slider-arrow"
                        @click="$refs.renovationsTrack.scrollBy({left: 360, behavior: 'smooth'})"
                        aria-label="Suivant">
                        →
                    </button>
                </div>
            </div>

            {{-- Track --}}
            <div class="slider-track" x-ref="renovationsTrack">
                @forelse($comparaisons as $comparaison)
                    <div class="slider-card slider-card--compare">
                        <x-compare-card
                            :number="$comparaison->id"
                            :title="$comparaison->title"
                            :before="$comparaison->before_image"
                            :after="$comparaison->after_image"
                        />
                    </div>
                @empty
                @endforelse
            </div>

        </section>

    </main>

@endsection
