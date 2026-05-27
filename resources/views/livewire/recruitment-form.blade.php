<div>
    <main class="recrutement-page">
        <div class="recrutement-card">

            <div class="recrutement-head">
                <h2 class="recrutement-title">Postuler à L'art de la pierre</h2>
                <div class="recrutement-rule"></div>
            </div>

            @if ($isSubmitted)
                <div class="recrutement-success-box">
                    <div class="success-icon">✓</div>
                    <h3>Candidature bien reçue !</h3>
                    <p>Merci pour votre intérêt. Notre équipe va étudier votre dossier avec la plus grande attention et reviendra vers vous très prochainement.</p>
                </div>
            @else
                <form wire:submit="save" enctype="multipart/form-data">

                    <div class="form-grid">
                        <div class="form-group">
                            <label class="form-label">Prénom</label>
                            <input type="text" wire:model="first_name" class="form-input" placeholder="Jean">
                            @error('first_name') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label class="form-label">Nom</label>
                            <input type="text" wire:model="last_name" class="form-input" placeholder="Dupont">
                            @error('last_name') <span class="form-error">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" wire:model="email" class="form-input" placeholder="jean.dupont@exemple.com">
                        @error('email') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label class="form-label">Téléphone</label>
                        <input type="text" wire:model="phone" class="form-input" placeholder="06 12 34 56 78">
                        @error('phone') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-divider"></div>

                    <div class="form-file-area">
                        <label class="form-file-label">Votre CV (PDF obligatoire)</label>
                        <span class="form-file-sublabel">Format PDF</span>

                        <div class="form-file-row">
                            <label class="form-file-btn">
                                Choisir un fichier
                                <input type="file" wire:model="cv" style="display: none;">
                            </label>

                            <div wire:loading wire:target="cv" class="upload-status loading">
                                ⏳ Upload en cours...
                            </div>
                            <div wire:loading.remove wire:target="cv">
                                @if ($cv)
                                    <span class="upload-status ready">✅ Fichier prêt</span>
                                @else
                                    <span class="upload-status empty">Aucun fichier sélectionné</span>
                                @endif
                            </div>
                        </div>
                        @error('cv') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-file-area">
                        <label class="form-file-label">Lettre de motivation (PDF facultatif)</label>
                        <span class="form-file-sublabel">Format PDF</span>

                        <div class="form-file-row">
                            <label class="form-file-btn">
                                Choisir un fichier
                                <input type="file" wire:model="cover_letter" style="display: none;">
                            </label>

                            <div wire:loading wire:target="cover_letter" class="upload-status loading">
                                ⏳ Upload en cours...
                            </div>
                            <div wire:loading.remove wire:target="cover_letter">
                                @if ($cover_letter)
                                    <span class="upload-status ready">✅ Fichier prêt</span>
                                @else
                                    <span class="upload-status empty">Aucun fichier sélectionné</span>
                                @endif
                            </div>
                        </div>
                        @error('cover_letter') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" wire:loading.attr="disabled" class="form-submit">
                        <span wire:loading.remove>Envoyer mon dossier</span>
                        <span wire:loading>Envoi en cours...</span>
                    </button>
                </form>
            @endif

            <p class="recrutement-note">
                L'art de la pierre s'engage à traiter votre dossier en toute confidentialité.<br>
            </p>

        </div>
    </main>
</div>
