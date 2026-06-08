@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto px-6 py-24 font-sans text-[#44403c] leading-relaxed">
        <span class="text-xs uppercase tracking-widest text-[#b0a494] block mb-2">Protection des données</span>
        <h1 class="font-serif text-4xl mb-4 text-[#292524]">Politique de Confidentialité</h1>
        <div class="w-12 h-[1px] bg-[#b0a494] mb-12"></div>

        <div class="space-y-8">
            <p class="italic">
                Dernière mise à jour : Juin 2026. Chez Frédéric Oden, le respect de votre vie privée et la sécurité de vos données personnelles sont au cœur de notre démarche d'artisan.
            </p>

            <section>
                <h2 class="font-serif text-2xl mb-3 text-[#292524]">1. Collecte des données personnelles</h2>
                <p class="mb-2">Nous collectons des informations personnelles uniquement lorsque vous utilisez les formulaires du site :</p>
                <ul class="list-disc pl-5 space-y-1">
                    <li><strong>Configurateur de devis :</strong> Nom, prénom, adresse e-mail, numéro de téléphone, dimensions de la pierre demandée et note optionnelle.</li>
                    <li><strong>Formulaire de recrutement :</strong> Nom, prénom, e-mail, téléphone, CV et lettre de motivation.</li>
                </ul>
            </section>

            <section>
                <h2 class="font-serif text-2xl mb-3 text-[#292524]">2. Utilisation de vos données</h2>
                <p class="mb-2">Vos données sont traitées pour des finalités strictes :</p>
                <ul class="list-disc pl-5 space-y-1">
                    <li>Étudier et répondre à vos demandes de devis sur-mesure pour vos projets de taille de pierre.</li>
                    <li>Évaluer les profils de candidats postulant au sein de notre atelier via le module de recrutement.</li>
                </ul>
                <p class="mt-2">Ces données ne seront <strong>jamais</strong> cédées, vendues ou louées à des tiers à des fins commerciales.</p>
            </section>

            <section>
                <h2 class="font-serif text-2xl mb-3 text-[#292524]">3. Conservation et Sécurité</h2>
                <p>
                    Les documents de recrutement (CV, lettres) et les demandes de devis sont conservés pendant la durée nécessaire à leur traitement ou au maximum pendant la durée légale applicable. Nous mettons en œuvre des mesures de sécurité techniques (notamment via le protocole sécurisé HTTPS et la protection CSRF de Laravel) pour empêcher tout accès non autorisé à vos informations.
                </p>
            </section>

            <section>
                <h2 class="font-serif text-2xl mb-3 text-[#292524]">4. Cookies</h2>
                <p>
                    Ce site web utilise uniquement des cookies de session indispensables à son bon fonctionnement technique (comme la gestion de la sécurité des formulaires). Aucun outil de traçage publicitaire ou comportemental invasif n'est activé à votre insu.
                </p>
            </section>

            <section>
                <h2 class="font-serif text-2xl mb-3 text-[#292524]">5. Vos Droits (RGPD)</h2>
                <p>
                    Conformément au Règlement Général sur la Protection des Données (RGPD), vous disposez d'un droit d'accès, de rectification, de suppression ou de portabilité de vos données personnelles. Pour exercer ces droits, vous pouvez nous contacter directement par e-mail à : <a href="mailto:frederic.oden.tailleur.pierre@gmail.com" class="text-[#b0a494] underline">frederic.oden.tailleur.pierre@gmail.com</a>.
                </p>
            </section>
        </div>
    </div>
@endsection
