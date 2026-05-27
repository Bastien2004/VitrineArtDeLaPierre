<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frédéric Oden | Art de la Pierre</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,500;1,400&family=Montserrat:wght@200;400&display=swap" rel="stylesheet">
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

{{-- Navbar : toujours opaque par défaut.
     Uniquement sur la page d'accueil, le JS retire .scrolled
     au chargement et le rétablit au scroll. --}}
<nav class="navbar scrolled" id="navbar">
    <div class="logo">F. ODEN</div>
    <ul class="nav-links">
        <li><a href="/">Savoir-Faire</a></li>
        <li><a href="/">Réalisations</a></li>
        <li><a href="/configurateur">Devis</a></li>
        <li><a href="{{ route('recrutement') }}">Recrutement</a></li>
        <li><a href="#">Contact</a></li>
    </ul>
</nav>

@yield('content')
@livewireScripts

<footer class="footer">
    <div class="footer-line"></div>
    <p>© 2026 FRÉDÉRIC ODEN — TAILLEUR DE PIERRE & SCULPTEUR</p>
</footer>

<script>
    (function () {
        const navbar  = document.getElementById('navbar');
        const isHome  = document.querySelector('.hero') !== null;

        if (!isHome) return; // Toutes les autres pages : navbar opaque fixe, rien à faire

        // Page d'accueil uniquement : transparent au top, opaque au scroll
        navbar.classList.remove('scrolled');

        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 60);
        }, { passive: true });
    })();
</script>

@stack('scripts')
</body>
</html>
