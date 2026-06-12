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

<div class="nav-mobile-menu" id="nav-mobile-menu" aria-hidden="true">

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

<footer class="footer-minimal w-full px-8 py-6 text-gray-500 text-xs bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">

        <div class="flex flex-col sm:flex-row items-center gap-2 sm:gap-4 text-center sm:text-left">
            <span class="font-bold text-gray-800 tracking-wide">Frédéric Oden</span>
            <span class="hidden sm:inline text-gray-300">|</span>
            <p class="uppercase tracking-wider text-[10px] text-gray-400">© {{ date('Y') }} — Tailleur de Pierre & Sculpteur</p>
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-6">

            <div class="flex items-center gap-4 border-b border-gray-100 pb-2 sm:pb-0 sm:border-b-0 sm:pr-2">
                <a href="tel:0615850625" class="flex items-center gap-1.5 hover:text-gray-900 transition-colors duration-200">
                    <svg class="w-3.5 h-3.5 opacity-70" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-1.514 2.02a13.717 13.717 0 0 1-6.005-6.005l2.02-1.514c.267-.355.38-.823.272-1.26a1.248 1.248 0 0 0-.853-1.012l-4.423-1.1a1.248 1.248 0 0 0-1.4.757V6.75Z" />
                    </svg>
                    06 15 85 06 25
                </a>
                <span class="text-gray-200">|</span>
                <a href="mailto:frederic.oden.tailleur.pierre@gmail.com" class="flex items-center gap-1.5 hover:text-gray-900 transition-colors duration-200">
                    <svg class="w-3.5 h-3.5 opacity-70" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                    </svg>
                    frederic.oden.tailleur.pierre@gmail.com
                </a>
            </div>

            <div class="flex items-center gap-3 text-gray-400">
                <a href="{{ route('mentions-legales') }}" class="hover:text-gray-700 hover:underline transition-colors">Mentions légales</a>
                <span>·</span>
                <a href="{{ route('politique-confidentialite') }}" class="hover:text-gray-700 hover:underline transition-colors">Confidentialité</a>
                <span>·</span>

                <span class="text-gray-400">Développé par
                    <a href="https://guideon.dev" class="inline-block ml-0.5 font-semibold text-gray-600 hover:text-blue-600 hover:drop-shadow-[0_0_6px_rgba(37,99,235,0.3)] transition-all duration-300 tracking-wide">
                        GuideOn
                    </a>
                </span>
            </div>

        </div>

    </div>
</footer>


<script>
    (function () {
        const navbar = document.getElementById('navbar');
        const isHome = document.querySelector('.hero') !== null;
        if (!isHome) return;
        navbar.classList.remove('scrolled');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 60);
        }, { passive: true });
    })();

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

        btn.addEventListener('click', () => {
            btn.classList.contains('open') ? closeMenu() : openMenu();
        });

        closeBtn.addEventListener('click', closeMenu);

        menu.querySelectorAll('a').forEach(link => link.addEventListener('click', closeMenu));

        menu.addEventListener('click', function (e) {
            if (e.target === menu) closeMenu();
        });

        document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMenu(); });
    })();
</script>

@stack('scripts')
</body>
</html>
