@extends('layouts.app')

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

                        <div class="about-signature-wrapper">
                            <img src="{{ asset('images/signature.gif') }}" alt="Signature Frédéric Oden" class="about-signature">
                        </div>
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

        <section class="py-20" x-data="{}">
            <div class="px-10 mb-12 flex justify-between items-end">
                <div>
                    <h2 class="text-4xl font-serif italic text-gray-800">Nos réalisations</h2>
                    <div class="h-px w-20 bg-gray-400 mt-2"></div>
                </div>
                <div class="flex gap-2">
                    <button @click="$refs.scrollContainer.scrollBy({left: -400, behavior: 'smooth'})" class="w-12 h-12 border border-gray-300 rounded-full hover:bg-gray-100 flex items-center justify-center transition-all duration-300 hover:scale-105">←</button>
                    <button @click="$refs.scrollContainer.scrollBy({left: 400, behavior: 'smooth'})" class="w-12 h-12 border border-gray-300 rounded-full hover:bg-gray-100 flex items-center justify-center transition-all duration-300 hover:scale-105">→</button>
                </div>
            </div>

            <div x-ref="scrollContainer" class="flex overflow-x-auto snap-x snap-mandatory gap-8 px-10 pb-12 hide-scrollbar scroll-smooth">
                @forelse($items as $id => $paths)
                    @if(isset($paths['before']) && isset($paths['after']))
                        <div class="snap-start shrink-0">
                            <x-compare-card
                                :number="$id"
                                :title="$paths['title']"
                                :before="$paths['before']"
                                :after="$paths['after']"
                            />
                        </div>
                    @endif
                @empty
                @endforelse
            </div>
        </section>

    </main>

@endsection
