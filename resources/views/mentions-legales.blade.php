@extends('layouts.app')

@php
    SEO::setTitle('Mentions Légales — Frédéric Oden');
    SEO::setDescription('Consultez les mentions légales de l’atelier Frédéric Oden, tailleur de pierre et sculpteur, hébergé par OVH Cloud.');
@endphp

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/legales.css') }}">
@endpush


@section('content')
    {!! SEO::generate() !!}
    <div class="legal-container min-h-screen px-6 py-20 sm:py-32">
        <div class="max-w-3xl mx-auto">

            <!-- En-tête simple et élégant -->
            <div class="border-b border-stone-200 pb-8 mb-12">
                <span class="text-xs uppercase tracking-widest text-stone-400 font-medium block mb-2">Informations obligatoires</span>
                <h1 class="legal-title text-4xl sm:text-5xl text-stone-900">Mentions Légales</h1>
                <p class="text-sm text-stone-400 font-sans mt-2">Atelier Frédéric Oden — Tailleur de pierre & Sculpteur</p>
            </div>

            <!-- Contenu linéaire et lisible -->
            <div class="space-y-12">

                <!-- Bloc 1 : Édition -->
                <div class="legal-section">
                    <h2 class="legal-section-title text-xl font-medium text-stone-900 mb-4">Édition du site</h2>
                    <div class="legal-content space-y-3">
                        <p>
                            Le site internet <strong>Frédéric Oden</strong> est édité par l'entreprise individuelle de Frédéric Oden, spécialisée dans la taille de pierre et la sculpture.
                        </p>
                        <p class="pt-2 text-sm text-stone-500 border-t border-stone-100">
                            <strong>Siège social :</strong> Bellignies, France (Nord)<br>
                            <strong>Directeur de la publication :</strong> Frédéric Oden<br>
                            <strong>Contact :</strong> <a href="mailto:frederic.oden.tailleur.pierre@gmail.com" class="legal-link">frederic.oden.tailleur.pierre@gmail.com</a>
                        </p>
                    </div>
                </div>

                <!-- Bloc 2 : Hébergement (Mis à jour pour OVH) -->
                <div class="legal-section">
                    <h2 class="legal-section-title text-xl font-medium text-stone-900 mb-4">Hébergement</h2>
                    <div class="legal-content space-y-3">
                        <p>
                            Le site est hébergé par la société <strong>OVH Cloud</strong>.
                        </p>
                        <p class="pt-2 text-sm text-stone-500 border-t border-stone-100">
                            <strong>Adresse :</strong> 2 rue Kellermann, 59100 Roubaix, France<br>
                            <strong>Site internet :</strong> <a href="https://www.ovhcloud.com" target="_blank" class="legal-link">www.ovhcloud.com</a>
                        </p>
                    </div>
                </div>

                <!-- Bloc 3 : Crédits -->
                <div class="legal-section">
                    <h2 class="legal-section-title text-xl font-medium text-stone-900 mb-4">Design & Développement</h2>
                    <div class="legal-content space-y-3">
                        <p>
                            L'architecture de l'application, l'optimisation des panoramas ainsi que le configurateur 3D sur-mesure ont été façonnés par :
                        </p>
                        <p class="pt-2 text-sm text-stone-500 border-t border-stone-100">
                            <strong>GuideOn</strong> — <a href="https://guideon.dev" target="_blank" class="legal-link">https://guideon.dev</a>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
