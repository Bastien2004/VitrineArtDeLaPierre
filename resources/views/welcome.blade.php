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
                        <p class="about-lead">
                            C'est à l'âge de 15 ans que je me suis laissé guider par ma passion : l'Art de la pierre.
                        </p>
                        <p>
                            Apprenti, j'ai eu l'opportunité d'être formé par un artiste-sculpteur tel que <strong>Charles Poitoux</strong> au sein de la marbrerie Vital-Evrard à Bellignies. La collaboration avec ce créateur m'a fourni les clés pour trouver ma propre voie...
                        </p>
                        <p>
                            À la fin de mes études aux Beaux-Arts de Montpellier en 1995, j'ai pris mon envol en créant mon entreprise à Bellignies, pays de la pierre bleue et du marbre.
                        </p>
                        <p class="about-quote">
                            Depuis maintenant plus de 20 ans, je transforme la matière brute et prends plaisir à la "faire vivre" en un mouvement subtil, une forme élégante qui traverse le temps, reflétant une histoire unique.
                        </p>
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

        {{-- ── RÉALISATIONS (slider avec flèches) ── --}}
        <section class="py-20 realisations" x-data="{}">
            <div class="px-10 mb-12 flex justify-between items-center">
                <div>
                    <h2 class="text-4xl font-serif italic text-gray-800">Nos réalisations</h2>
                    <div class="h-px w-20 bg-gray-400 mt-2"></div>
                </div>
                <div class="flex gap-2">
                    <button
                        @click="$refs.realisationsScroll.scrollBy({left: -340, behavior: 'smooth'})"
                        aria-label="Précédent">←</button>
                    <button
                        @click="$refs.realisationsScroll.scrollBy({left: 340, behavior: 'smooth'})"
                        aria-label="Suivant">→</button>
                </div>
            </div>

            <div
                x-ref="realisationsScroll"
                class="realisations-scroll hide-scrollbar"
            >
                @forelse($realisations as $realisation)
                    <div class="realisation-card group">
                        <img
                            src="{{ Storage::url($realisation->image) }}"
                            alt="{{ $realisation->title }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                        <div class="realisation-card-overlay">
                            <p class="text-white font-serif italic text-lg leading-tight">{{ $realisation->title }}</p>
                            @if($realisation->category)
                                <span class="text-white/70 text-sm mt-1 block">{{ $realisation->category }}</span>
                            @endif
                        </div>
                    </div>
                @empty
                @endforelse
            </div>
        </section>

        {{-- ── RÉNOVATIONS (slider existant) ── --}}
        <section class="py-20 renovations" x-data="{}">
            <div class="px-10 mb-12 flex justify-between items-end">
                <div>
                    <h2 class="text-4xl font-serif italic text-gray-800">Nos rénovations</h2>
                    <div class="h-px w-20 bg-gray-400 mt-2"></div>
                </div>
                <div class="flex gap-2">
                    <button @click="$refs.scrollContainer.scrollBy({left: -400, behavior: 'smooth'})" aria-label="Précédent">←</button>
                    <button @click="$refs.scrollContainer.scrollBy({left: 400, behavior: 'smooth'})" aria-label="Suivant">→</button>
                </div>
            </div>

            <div x-ref="scrollContainer" class="flex overflow-x-auto snap-x snap-mandatory gap-8 px-10 pb-12 hide-scrollbar scroll-smooth">
                @forelse($comparaisons as $comparaison)
                    <div class="snap-start shrink-0">
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
