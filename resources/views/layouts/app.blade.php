<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {!! SEO::generate() !!}
    @stack('seo')
    <link rel="icon" href="{{ asset('images/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400&family=Montserrat:wght@200;300;400&family=Plus+Jakarta+Sans:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        .font-serif { font-family: 'Cormorant Garamond', serif; }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
    @stack('styles')
</head>
<body class="bg-[#FDFCFA]">

<nav class="navbar scrolled" id="navbar">
    <a href="/" class="logo">Frédéric Oden</a>

    <ul class="nav-links">
        <li><a href="{{route('panoramas')}}">Explorer l’atelier</a></li>
        <li><a href="/configurateur">Devis</a></li>
        <li><a href="https://www.pagesjaunes.fr/contribution/votre-avis/62047963">Avis</a></li>
        <li><a href="{{ route('recrutement') }}">Recrutement</a></li>
    </ul>

    <button class="nav-hamburger" id="nav-hamburger" aria-label="Ouvrir le menu" aria-expanded="false">
        <span></span>
        <span></span>
        <span></span>
    </button>
</nav>

{{-- Menu plein écran mobile --}}
<div class="nav-mobile-menu" id="nav-mobile-menu" aria-hidden="true">

    {{-- Bouton fermeture en haut à droite --}}
    <button class="nav-mobile-close" id="nav-mobile-close" aria-label="Fermer le menu">
        <span></span>
        <span></span>
    </button>

    <a href="/">Accueil</a>
    <a href="{{route('panoramas')}}">Explorer l’atelier</a>
    <a href="/configurateur">Devis</a>
    <a href="https://www.pagesjaunes.fr/contribution/votre-avis/62047963">Avis</a>
    <div class="nav-mobile-divider"></div>
    <a href="{{ route('recrutement') }}" class="nav-mobile-cta">Recrutement</a>
</div>

@yield('content')
@livewireScripts

<footer class="footer-minimal w-full px-8 py-6">
    <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-4">

        <div class="flex items-center gap-4">
            <span class="footer-min-logo">Frédéric Oden</span>
            <span class="footer-min-sep">|</span>
            <p class="footer-min-copyright">© {{ date('Y') }} — TAILLEUR DE PIERRE & SCULPTEUR</p>
        </div>
        <a href="{{ route('mentions-legales') }}" class="text-xs text-gray-500 hover:underline">Mentions légales</a>
        <span class="footer-min-sep">|</span>
        <a href="{{ route('politique-confidentialite') }}" class="text-xs text-gray-500 hover:underline">Confidentialité</a>
        <a href="https://guideon.dev" class="guideon">Développé par GuideOn</a>

    </div>
</footer>

<script>
    /* ── Navbar transparente sur hero ── */
    (function () {
        const navbar = document.getElementById('navbar');
        const isHome = document.querySelector('.hero') !== null;
        if (!isHome) return;
        navbar.classList.remove('scrolled');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 60);
        }, { passive: true });
    })();

    /* ── Menu hamburger ── */
    (function () {
        const btn       = document.getElementById('nav-hamburger');
        const closeBtn  = document.getElementById('nav-mobile-close');
        const menu      = document.getElementById('nav-mobile-menu');

        function openMenu() {
            btn.classList.add('open');
            menu.classList.add('open');
            btn.setAttribute('aria-expanded', 'true');
            menu.setAttribute('aria-hidden', 'false');
            document.body.style.overflow = 'hidden';
        }

        function closeMenu() {
            btn.classList.remove('open');
            menu.classList.remove('open');
            btn.setAttribute('aria-expanded', 'false');
            menu.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }

        /* Ouvre/ferme via le hamburger */
        btn.addEventListener('click', () => {
            btn.classList.contains('open') ? closeMenu() : openMenu();
        });

        /* Ferme via le bouton ✕ dans le menu */
        closeBtn.addEventListener('click', closeMenu);

        /* Ferme au clic sur un lien */
        menu.querySelectorAll('a').forEach(link => link.addEventListener('click', closeMenu));

        /* Ferme au clic sur le fond (hors liens) */
        menu.addEventListener('click', function (e) {
            if (e.target === menu) closeMenu();
        });

        /* Ferme avec Escape */
        document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMenu(); });
    })();
</script>

@stack('scripts')
</body>
</html>
