<div>
    <main class="py-20">
        <div class="max-w-xl mx-auto p-6 bg-white rounded-lg shadow border-t-4 border-gray-800">
            <h2 class="text-2xl font-serif mb-6 text-gray-800 uppercase tracking-widest">Postuler à l'Atelier</h2>

            @if (session()->has('message'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded border border-green-200">
                    {{ session('message') }}
                </div>
            @endif

            <form wire:submit="save" enctype="multipart/form-data" class="space-y-4">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold">Prénom</label>
                        <input type="text" wire:model="first_name" class="w-full border-gray-300 rounded shadow-sm">
                        @error('first_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold">Nom</label>
                        <input type="text" wire:model="last_name" class="w-full border-gray-300 rounded shadow-sm">
                        @error('last_name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-semibold">Email</label>
                    <input type="email" wire:model="email" class="w-full border-gray-300 rounded shadow-sm">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold">Téléphone</label>
                    <input type="text" wire:model="phone" class="w-full border-gray-300 rounded shadow-sm">
                    @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="py-2">
                    <label class="block text-sm font-semibold text-gray-700">Votre CV (PDF obligatoire)</label>
                    <input type="file" wire:model="cv" class="mt-1 block w-full text-sm">

                    <div wire:loading wire:target="cv" class="text-sm text-blue-500 mt-1">
                        ⏳ Upload en cours...
                    </div>
                    <div wire:loading.remove wire:target="cv">
                        @if ($cv)
                            <p class="text-sm text-green-600 mt-1">✅ Fichier prêt</p>
                        @endif
                    </div>
                    @error('cv') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <div class="py-2">
                    <label class="block text-sm font-semibold text-gray-700">Lettre de motivation (PDF facultatif)</label>
                    <input type="file" wire:model="cover_letter" class="mt-1 block w-full text-sm">

                    <div wire:loading wire:target="cover_letter" class="text-sm text-blue-500 mt-1">
                        ⏳ Upload en cours...
                    </div>
                    <div wire:loading.remove wire:target="cover_letter">
                        @if ($cover_letter)
                            <p class="text-sm text-green-600 mt-1">✅ Fichier prêt</p>
                        @endif
                    </div>
                    @error('cover_letter') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                <button
                    type="submit"
                    wire:loading.attr="disabled"
                    wire:loading.class="opacity-50 cursor-not-allowed"
                    class="w-full bg-gray-900 text-white py-3 px-4 rounded hover:bg-gray-700 transition font-bold uppercase tracking-widest"
                >
                    <span wire:loading.remove>Envoyer mon dossier</span>
                    <span wire:loading>Envoi en cours...</span>
                </button>
            </form>
        </div>
    </main>
</div>
