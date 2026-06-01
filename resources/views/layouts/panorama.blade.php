<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panorama 360°')</title>
    @stack('styles')
</head>
<body>
@yield('content')
@stack('scripts')
</body>
</html>
