@extends('layouts.app')

@section('content')

    <div class="page">



        <div class="contact-card">
            <p class="contact-card__intro">Une question avant de commencer ? Contactez-nous directement.</p>
            <div class="contact-card__items">
                <a href="tel:+33615850625" class="contact-card__item">
                    <span class="contact-card__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12 19.79 19.79 0 0 1 1.61 3.4 2 2 0 0 1 3.6 1.22h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L7.91 8.8a16 16 0 0 0 6 6l.94-1.94a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                    </svg>
                </span>
                    <span class="contact-card__label">06 15 85 06 25</span>
                </a>
                <div class="contact-card__divider"></div>
                <a href="mailto:frederic.oden.tailleur.pierre@gmail.com" class="contact-card__item">
                <span class="contact-card__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="16" x="2" y="4" rx="2"/>
                        <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                    </svg>
                </span>
                    <span class="contact-card__label">frederic.oden.tailleur.pierre@gmail.com</span>
                </a>
            </div>
        </div>

        <div class="add-btn-container">
            <button class="add-btn" onclick="ajouterPierre(true)">
                <span class="plus-icon">+</span>
                Ajouter une pierre
            </button>
        </div>

        <div id="liste-pierres"></div>

        <div class="client-form">
            <div class="client-form-grid">
                <div class="client-field">
                    <label for="nom-client">Nom</label>
                    <input type="text" id="nom-client" placeholder="Dupont" required>
                </div>
                <div class="client-field">
                    <label for="prenom-client">Prénom</label>
                    <input type="text" id="prenom-client" placeholder="Jean" required>
                </div>
                <div class="client-field">
                    <label for="email-client">Adresse mail</label>
                    <input type="email" id="email-client" placeholder="jean@example.com" required>
                </div>
                <div class="client-field">
                    <label for="telephone-client">Téléphone</label>
                    <input type="tel" id="telephone-client" placeholder="06 00 00 00 00" required>
                </div>
            </div>

            <div class="client-field" style="margin-top: 14px;">
                <label for="note-client">Note ou précision</label>
                <textarea id="note-client" placeholder="Ajouter une note ou précision sur votre commande..."></textarea>
            </div>

            <div style="margin-top: 20px;">
                <button class="add-btn" onclick="envoyerMail()" id="btn-mail">
                    <span class="plus-icon">✉</span>
                    Envoyer par mail
                </button>
            </div>
        </div>

    </div>

    <div id="notif-container"></div>

    <template id="pierre-template">
        <div class="layout stone-instance">
            <div class="canvas-wrap">
                <div class="canvas-stage">
                    <svg viewBox="0 0 320 180" xmlns="http://www.w3.org/2000/svg">
                        <line x1="40" y1="15" x2="280" y2="15" stroke="#A8A29E" stroke-width="0.5" stroke-dasharray="2 2"/>
                        <text x="160" y="10" text-anchor="middle" class="dim-label s-txt-w">120 cm</text>
                        <line x1="15" y1="25" x2="15" y2="125" stroke="#A8A29E" stroke-width="0.5" stroke-dasharray="2 2"/>
                        <text x="10" y="75" text-anchor="middle" class="dim-label s-txt-h" transform="rotate(-90, 10, 75)">20 cm</text>
                        <rect class="s-body" x="40" y="25" width="240" height="100" rx="2" fill="#D6CCBC" stroke="#B0A494" stroke-width="1"/>
                        <rect class="s-el" x="22" y="25" width="18" height="50" rx="1" fill="#C8BEAE" stroke="#B0A494" stroke-width="1" opacity="0"/>
                        <rect class="s-er" x="280" y="25" width="18" height="50" rx="1" fill="#C8BEAE" stroke="#B0A494" stroke-width="1" opacity="0"/>
                        <rect class="s-rj" x="40" y="121" width="240" height="9" fill="#B8AA98" stroke="#9A8E7E" stroke-width="1" opacity="0"/>
                        <g class="s-ci" opacity="0">
                            <rect x="40" y="115" width="240" height="10" rx="2" fill="none" stroke="#B0A494" stroke-width="14" opacity="0.3"/>
                            <line x1="54" y1="115" x2="54" y2="125" stroke="#A09080" stroke-width="0.5"/>
                            <line x1="266" y1="115" x2="266" y2="125" stroke="#A09080" stroke-width="0.5"/>
                        </g>
                        <line class="s-cg" x1="45" y1="118" x2="275" y2="118" stroke="#78716C" stroke-width="1.5" stroke-dasharray="4 2" opacity="0"/>
                    </svg>
                </div>
                <div class="tag-row"></div>
            </div>

            <div class="panel">
                <div class="panel-section">
                    <span class="sec-label">Dimensions (cm)</span>
                    <div class="dim-inputs">
                        <div class="input-group">
                            <label>Longueur</label>
                            <input type="number" class="in-w" value="120" min="1">
                        </div>
                        <div class="input-group">
                            <label>Largeur</label>
                            <input type="number" class="in-h" value="20" min="1">
                        </div>
                        <div class="input-group">
                            <label>Épaisseur</label>
                            <input type="number" class="in-z" value="3" min="1" max="30">
                        </div>
                    </div>
                </div>

                <div class="panel-section">
                    <span class="sec-label">Finitions</span>
                    <div class="fin-grid">
                        <button class="fin-btn" data-type="or">
                            <div class="fin-indicator"></div>
                            <span class="fin-name">Oreille</span>
                        </button>
                        <button class="fin-btn" data-type="rj">
                            <div class="fin-indicator"></div>
                            <span class="fin-name">Rejingot</span>
                        </button>
                        <button class="fin-btn" data-type="ci">
                            <div class="fin-indicator"></div>
                            <span class="fin-name">Ciselage</span>
                        </button>
                        <button class="fin-btn" data-type="cg">
                            <div class="fin-indicator"></div>
                            <span class="fin-name">Casse-goutte</span>
                        </button>
                    </div>
                </div>

                <div class="panel-section">
                    <p class="desc-text">Ajustez les dimensions et finitions.</p>
                </div>

                <div class="panel-section" style="padding:0">
                    <button class="delete-btn" onclick="supprimerPierre(this)">Supprimer</button>
                </div>
            </div>
        </div>
    </template>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/configurateur.css') }}">
@endpush

@push('scripts')
    <script>
        const descs = {
            or: "Débord latéral (oreille) pour encastrement dans la maçonnerie.",
            rj: "Rejingot assurant l'étanchéité et limitant les infiltrations d'eau.",
            ci: "Bande périphérique bouchardée ou ciselée pour un aspect traditionnel.",
            cg: "Rainure (larmier) taillée sous la pierre pour éviter le ruissellement d'eau vers la façade."
        };
        const names = { or: 'Oreilles', rj: 'Rejingot', ci: 'Ciselage', cg: 'Casse-goutte' };

        function notifier(message) {
            const container = document.getElementById('notif-container');
            const notif = document.createElement('div');
            notif.className = 'notif';
            notif.textContent = message;
            container.appendChild(notif);
            setTimeout(() => notif.remove(), 3100);
        }

        function updateCount() {
            const n = document.querySelectorAll('.stone-instance').length;
            const el = document.getElementById('stone-count');
            el.textContent = n > 0 ? `${n} pierre${n > 1 ? 's' : ''}` : '';
        }

        function ajouterPierre(notify = false) {
            const template = document.getElementById('pierre-template');
            const container = document.getElementById('liste-pierres');
            const clone = template.content.cloneNode(true);
            const instance = clone.querySelector('.stone-instance');

            instance.state = { or: false, rj: false, ci: false, cg: false, w: 120, h: 20, z: 5 };

            instance.querySelectorAll('.fin-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const type = btn.getAttribute('data-type');
                    instance.state[type] = !instance.state[type];
                    updateInstance(instance, type);
                });
            });

            instance.querySelector('.in-w').addEventListener('input', (e) => { instance.state.w = e.target.value; updateInstance(instance); });
            instance.querySelector('.in-h').addEventListener('input', (e) => { instance.state.h = e.target.value; updateInstance(instance); });
            instance.querySelector('.in-z').addEventListener('input', (e) => { instance.state.z = e.target.value; updateInstance(instance); });

            container.appendChild(clone);
            updateInstance(instance);
            updateCount();

            if (notify) notifier("Nouvelle pierre ajoutée");
        }

        function supprimerPierre(btn) {
            const instance = btn.closest('.stone-instance');
            instance.classList.add('removing');
            setTimeout(() => {
                instance.remove();
                updateCount();
                notifier("Pierre retirée de la liste");
            }, 220);
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
            vis('.s-cg', st.cg);

            instance.querySelector('.s-txt-w').textContent = `${st.w} cm`;
            instance.querySelector('.s-txt-h').textContent = `${st.h} cm`;

            const tagRow = instance.querySelector('.tag-row');
            const active = Object.keys(names).filter(k => st[k]);
            tagRow.innerHTML = `<span class="tag">${st.w}x${st.h}x${st.z} cm</span>` +
                active.map(k => `<span class="tag on">${names[k]}</span>`).join('');
        }

        async function envoyerMail() {
            const instances = document.querySelectorAll('.stone-instance');

            if (instances.length === 0) {
                notifier("Aucune pierre à envoyer.");
                return;
            }

            const pierres = Array.from(instances).map(inst => inst.state);
            const nom     = document.getElementById('nom-client').value;
            const prenom  = document.getElementById('prenom-client').value;
            const email   = document.getElementById('email-client').value;
            const numero  = document.getElementById('telephone-client').value;
            const note    = document.getElementById('note-client').value;

            const btn = document.getElementById('btn-mail');
            btn.disabled = true;
            btn.querySelector('.plus-icon').textContent = '⏳';

            try {
                const response = await fetch('/configurateur/envoyer-mail', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    },
                    body: JSON.stringify({ pierres, nom, prenom, email, numero, note }),
                });

                if (!response.ok) throw new Error();
                notifier("✓ Demande envoyée ! Vous recevrez une confirmation une fois votre demande étudiée.");
            } catch {
                notifier("Erreur lors de l'envoi. Réessayez.");
            } finally {
                btn.disabled = false;
                btn.querySelector('.plus-icon').textContent = '✉';
            }
        }

        window.onload = () => ajouterPierre(false);
    </script>
@endpush
