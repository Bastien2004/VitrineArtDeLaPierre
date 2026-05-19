<!DOCTYPE html>
<html lang="fr">
<head><meta charset="UTF-8"><style>
        body { font-family: Arial, sans-serif; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th { background: #f5f0eb; padding: 8px 12px; text-align: left; font-size: 12px; }
        td { padding: 8px 12px; border-bottom: 1px solid #eee; font-size: 13px; }
        .badge { display: inline-block; background: #e8e0d4; padding: 2px 8px; border-radius: 4px; font-size: 11px; margin: 2px; }
    </style></head>
<body>

<h2>Configuration reçue — L'Art de la Pierre</h2>

<p>
    <strong>Nom :</strong> {{ $nom }} {{ $prenom }}<br>
    <strong>Téléphone :</strong> {{ $numero }}<br>
    <strong>Email :</strong> {{ $mail }}
</p>

<p>{{ count($pierres) }} pierre(s) configurée(s) :</p>

<table>
    <thead>
    <tr>
        <th>#</th>
        <th>Dimensions (cm)</th>
        <th>Finitions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($pierres as $i => $p)
        @php
            $finitions = [];
            if($p['or'] ?? false) $finitions[] = 'Oreilles';
            if($p['rj'] ?? false) $finitions[] = 'Rejingot';
            if($p['ci'] ?? false) $finitions[] = 'Ciselage';
            if($p['cg'] ?? false) $finitions[] = 'Casse-goutte';
        @endphp
        <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $p['w'] }} × {{ $p['h'] }} × {{ $p['z'] }} cm</td>
            <td>
                @forelse($finitions as $f)
                    <span class="badge">{{ $f }}</span>
                @empty
                    <span style="color:#999">Aucune</span>
                @endforelse
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@if($note)
    <div style="margin-top: 20px; padding: 12px 16px; background: #faf9f7;
                border-left: 3px solid #b0a494; font-size: 13px; color: #44403c;">
        <strong>Note du client :</strong><br>
        {{ $note }}
    </div>
@endif

</body>
</html>
