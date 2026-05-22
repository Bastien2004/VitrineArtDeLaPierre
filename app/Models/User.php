<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser; // <-- AJOUTER CETTE LIGNE
use Filament\Panel; // <-- AJOUTER CETTE LIGNE
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable implements FilamentUser // <-- MODIFIER CETTE LIGNE
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Autoriser l'accès à Filament en production
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // Autorise uniquement votre adresse email sur le VPS
        return $this->email === 'frederic.oden.tailleur.pierre@gmail.com';
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
