<?php

namespace App\Livewire;

use App\Models\Application;
use Livewire\Component;
use Livewire\WithFileUploads; // Indispensable pour les fichiers

class RecruitmentForm extends Component
{
    use WithFileUploads;

    // Les champs liés au formulaire (wire:model)
    public $first_name, $last_name, $email, $phone, $cv, $cover_letter;

    protected $rules = [
        'first_name' => 'required|min:2',
        'last_name' => 'required|min:2',
        'email' => 'required|email',
        'phone' => 'required',
        'cv' => 'required|mimes:pdf|max:3072', // PDF uniquement, 3Mo max
        'cover_letter' => 'nullable|mimes:pdf|max:3072',
    ];

    public function save()
    {
        $this->validate();

        Application::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'cv_path' => $this->cv->store('cvs', 'public'),
            'cover_letter_path' => $this->cover_letter
                ? $this->cover_letter->store('letters', 'public')
                : null,
        ]);

        session()->flash('message', 'Candidature bien reçue ! Nous reviendrons vers vous.');

        $this->reset();
    }

    public function render()
    {
        return view('livewire.recruitment-form')
            ->layout('layouts.app');
    }
}
