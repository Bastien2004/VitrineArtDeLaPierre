<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configurateur — L'Art de la Pierre</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@300;400;500&family=DM+Serif+Display:ital@0;1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/configurateur.css') }}">

</head>
<body>

<div class="page">
    <div class="header">
        <p class="eyebrow">Atelier de Taille</p>
        <h1>Vos pierres,<br><em>sur mesure</em></h1>
    </div>

    <div class="add-btn-container">
        <button class="add-btn" onclick="ajouterPierre()">+ Ajouter une pierre</button>
    </div>

    <div id="liste-pierres"></div>
</div>

<!-- Conteneur pour les notifications -->
<div id="notif-container"></div>

<template id="pierre-template">
    <div class="layout stone-instance">
        <div class="canvas-wrap">
            <div class="canvas-stage">
                <svg viewBox="0 0 320 180" xmlns="http://www.w3.org/2000/svg">
                    <line x1="40" y1="15" x2="280" y2="15" stroke="#A8A29E" stroke-width="0.5" stroke-dasharray="2 2" />
                    <text x="160" y="10" text-anchor="middle" class="dim-label s-txt-w">120 cm</text>
                    <line x1="15" y1="25" x2="15" y2="125" stroke="#A8A29E" stroke-width="0.5" stroke-dasharray="2 2" />
                    <text x="10" y="75" text-anchor="middle" class="dim-label s-txt-h" transform="rotate(-90, 10, 75)">20 cm</text>
                    <rect class="s-body" x="40" y="25" width="240" height="100" rx="2" fill="#D6CCBC" stroke="#B0A494" stroke-width="1"/>
                    <rect class="s-el" x="22" y="25" width="18" height="50" rx="1" fill="#C8BEAE" stroke="#B0A494" stroke-width="1" opacity="0"/>
                    <rect class="s-er" x="280" y="25" width="18" height="50" rx="1" fill="#C8BEAE" stroke="#B0A494" stroke-width="1" opacity="0"/>
                    <rect class="s-rj" x="40" y="121" width="240" height="9" fill="#B8AA98" stroke="#9A8E7E" stroke-width="1" opacity="0"/>
                    <g class="s-ci" opacity="0">
                        <rect x="40" y="25" width="240" height="100" rx="2" fill="none" stroke="#B0A494" stroke-width="14" opacity="0.3"/>
                        <line x1="54" y1="25" x2="54" y2="125" stroke="#A09080" stroke-width="0.5"/>
                        <line x1="266" y1="25" x2="266" y2="125" stroke="#A09080" stroke-width="0.5"/>
                    </g>
                </svg>
            </div>
            <div class="tag-row"></div>
        </div>

        <div class="panel">
            <div class="panel-section">
                <span class="sec-label">Dimensions (cm)</span>
                <div class="dim-inputs">
                    <div class="input-group">
                        <label>Largeur</label>
                        <input type="number" class="in-w" value="120" min="10" max="300">
                    </div>
                    <div class="input-group">
                        <label>Hauteur</label>
                        <input type="number" class="in-h" value="20" min="5" max="100">
                    </div>
                </div>
            </div>

            <div class="panel-section">
                <span class="sec-label">Finitions</span>
                <div class="fin-grid">
                    <button class="fin-btn" data-type="or">
                        <div class="fin-indicator"></div>
                        <span class="fin-name">Oreille</span>
                        <span class="fin-desc">Débord</span>
                    </button>
                    <button class="fin-btn" data-type="rj">
                        <div class="fin-indicator"></div>
                        <span class="fin-name">Rejingot</span>
                        <span class="fin-desc">Larmier</span>
                    </button>
                    <button class="fin-btn" data-type="ci">
                        <div class="fin-indicator"></div>
                        <span class="fin-name">Ciselage</span>
                        <span class="fin-desc">Pourtour</span>
                    </button>
                </div>
            </div>

            <div class="panel-section">
                <p class="desc-text">Ajustez les dimensions et finitions.</p>
            </div>

            <div class="panel-section" style="padding:0">
                <!-- On change l'appel ici pour gérer l'animation et le message -->
                <button class="delete-btn" onclick="supprimerPierre(this)">Supprimer</button>
            </div>
        </div>
    </div>
</template>

<script>
    const descs = {
        or: "Débord latéral (oreille) pour encastrement dans la maçonnerie.",
        rj: "Pente et larmier (rejingot) pour l'évacuation des eaux de pluie.",
        ci: "Bande périphérique bouchardée ou ciselée pour un aspect traditionnel."
    };

    const names = { or: 'Oreilles', rj: 'Rejingot', ci: 'Ciselage' };

    // --- Fonction de notification ---
    function notifier(message) {
        const container = document.getElementById('notif-container');
        const notif = document.createElement('div');
        notif.className = 'notif';
        notif.textContent = message;
        container.appendChild(notif);

        // Auto-suppression du DOM après l'animation
        setTimeout(() => notif.remove(), 3100);
    }

    function ajouterPierre() {
        const template = document.getElementById('pierre-template');
        const container = document.getElementById('liste-pierres');
        const clone = template.content.cloneNode(true);
        const instance = clone.querySelector('.stone-instance');

        instance.state = { or: false, rj: false, ci: false, w: 120, h: 20 };

        instance.querySelectorAll('.fin-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const type = btn.getAttribute('data-type');
                instance.state[type] = !instance.state[type];
                updateInstance(instance, type);
            });
        });

        instance.querySelector('.in-w').addEventListener('input', (e) => {
            instance.state.w = e.target.value;
            updateInstance(instance);
        });
        instance.querySelector('.in-h').addEventListener('input', (e) => {
            instance.state.h = e.target.value;
            updateInstance(instance);
        });

        container.appendChild(clone);
        updateInstance(instance);

        notifier("Nouvelle pierre ajoutée");
    }

    function supprimerPierre(btn) {
        const instance = btn.closest('.stone-instance');
        instance.classList.add('removing');

        // Attendre la fin de l'animation CSS avant de retirer du DOM
        setTimeout(() => {
            instance.remove();
            notifier("Pierre retirée de la liste");
        }, 300);
    }

    function updateInstance(instance, lastKey) {
        const st = instance.state;
        instance.querySelectorAll('.fin-btn').forEach(btn => {
            btn.classList.toggle('on', st[btn.getAttribute('data-type')]);
        });

        if (lastKey && st[lastKey]) {
            instance.querySelector('.desc-text').textContent = descs[lastKey];
        }

        const vis = (sel, op) => instance.querySelectorAll(sel).forEach(el => el.setAttribute('opacity', op ? '1' : '0'));
        vis('.s-el, .s-er', st.or);
        vis('.s-rj', st.rj);
        vis('.s-ci', st.ci);

        instance.querySelector('.s-txt-w').textContent = `${st.w} cm`;
        instance.querySelector('.s-txt-h').textContent = `${st.h} cm`;

        const tagRow = instance.querySelector('.tag-row');
        const active = Object.keys(names).filter(k => st[k]);
        tagRow.innerHTML = `<span class="tag">${st.w}x${st.h} cm</span>` +
            active.map(k => `<span class="tag on">${names[k]}</span>`).join('');
    }

    window.onload = ajouterPierre;
</script>
</body>
</html>
