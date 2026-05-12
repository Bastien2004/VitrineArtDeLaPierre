<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frédéric Oden | Art de la Pierre</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,500;1,400&family=Montserrat:wght@200;400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<!-- HEADER (Ton image 1) -->
<nav class="navbar">
    <div class="logo">F. ODEN</div>
    <ul class="nav-links">
        <li><a href="/">Artiste</a></li>
        <li><a href="#">Savoir-Faire</a></li>
        <li><a href="#">Réalisations</a></li>
        <li><a href="/configurateur">Devis</a></li>
        <li><a href="{{ route('recrutement') }}">Recrutement</a></li>
        <li><a href="#">Contact</a></li>
    </ul>
</nav>

<!-- CONTENU VARIABLE -->
<!-- C'est ici que Laravel injectera soit l'accueil, soit le formulaire -->
{{ $slot }}

<!-- FOOTER (Ton image 2) -->
<footer class="footer">
    <div class="footer-line"></div>
    <p>© 2026 FRÉDÉRIC ODEN — TAILLEUR DE PIERRE & SCULPTEUR</p>
</footer>

</body>
</html>
