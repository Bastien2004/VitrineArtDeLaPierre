@extends('layouts.app')
@use('Illuminate\Support\Facades\Storage')

@section('content')

    <header class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content"></div>
        <img class="hero-wave" src="{{ asset('images/vague.svg') }}" alt="">
    </header>

    <main>

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

        <section class="py-20">
            <div class="px-10 mb-12">
                <h2 class="text-4xl font-serif italic text-gray-800">Nos réalisations</h2>
                <div class="h-px w-20 bg-gray-400 mt-2"></div>
            </div>

            <div class="px-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($realisations as $realisation)
                    <div class="group relative overflow-hidden rounded-sm shadow-md border border-gray-200 aspect-[4/3] bg-gray-100">

                        <img src="{{ Storage::url($realisation->image) }}"
                             alt="{{ $realisation->title }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">

                        {{-- Overlay au survol --}}
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-5">
                            <p class="text-white font-serif italic text-lg leading-tight">{{ $realisation->title }}</p>
                            @if($realisation->category)
                                <span class="text-white/70 text-sm mt-1">{{ $realisation->category }}</span>
                            @endif
                        </div>

                    </div>
                @empty
                @endforelse
            </div>
        </section>

        <section class="py-20" x-data="{}">
            <div class="px-10 mb-12 flex justify-between items-end">
                <div>
                    <h2 class="text-4xl font-serif italic text-gray-800">Nos rénovations</h2>
                    <div class="h-px w-20 bg-gray-400 mt-2"></div>
                </div>
                <div class="flex gap-2">
                    <button @click="$refs.scrollContainer.scrollBy({left: -400, behavior: 'smooth'})" class="w-12 h-12 border border-gray-300 rounded-full hover:bg-gray-100 flex items-center justify-center transition-all duration-300 hover:scale-105">←</button>
                    <button @click="$refs.scrollContainer.scrollBy({left: 400, behavior: 'smooth'})" class="w-12 h-12 border border-gray-300 rounded-full hover:bg-gray-100 flex items-center justify-center transition-all duration-300 hover:scale-105">→</button>
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
