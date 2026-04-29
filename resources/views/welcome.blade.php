<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frédéric Oden | Tailleur de Pierre</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,500;1,400&family=Montserrat:wght@200;400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        .font-serif { font-family: 'Cormorant Garamond', serif; }
        .hide-scrollbar::-webkit-scrollbar { display: none; }
        .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-[#FDFDFD]">

<nav class="navbar">
    <div class="logo">F. ODEN</div>
    <ul class="nav-links">
        <li><a href="#">Artiste</a></li>
        <li><a href="#">Savoir-Faire</a></li>
        <li><a href="#">Réalisations</a></li>
        <li><a href="#">Contact</a></li>
    </ul>
</nav>

<header class="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content"></div>
</header>

<div class="stone-divider">
    <img src="{{ asset('images/vagueSousLogo.png') }}" alt="Sculpture">
</div>

<main class="py-20" x-data="{}">
    <div class="px-10 mb-12 flex justify-between items-end">
        <div>
            <h2 class="text-4xl font-serif italic text-gray-800">Nos Réalisations</h2>
            <div class="h-px w-20 bg-gray-400 mt-2"></div>
        </div>
        <div class="flex gap-2">
            <button @click="$refs.scrollContainer.scrollBy({left: -400, behavior: 'smooth'})" class="w-12 h-12 border border-gray-300 rounded-full hover:bg-gray-100">←</button>
            <button @click="$refs.scrollContainer.scrollBy({left: 400, behavior: 'smooth'})" class="w-12 h-12 border border-gray-300 rounded-full hover:bg-gray-100">→</button>
        </div>
    </div>

    <div x-ref="scrollContainer" class="flex overflow-x-auto snap-x snap-mandatory gap-8 px-10 pb-12 hide-scrollbar scroll-smooth">

        @forelse($items as $id => $paths)
            @if(isset($paths['before']) && isset($paths['after']))
                <x-compare-card
                    :number="$id"
                    :title="$paths['title']"
                    :before="$paths['before']"
                    :after="$paths['after']"
                />
            @endif
        @empty
        @endforelse
    </div>
</main>

<footer class="footer">
    <div class="footer-line"></div>
    <p>© 2026 FRÉDÉRIC ODEN — TAILLEUR DE PIERRE & SCULPTEUR</p>
</footer>

</body>
</html>
