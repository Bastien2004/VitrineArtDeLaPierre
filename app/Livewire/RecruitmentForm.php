<?php

namespace App\Livewire;

use App\Models\Application;
use Livewire\Component;
use Livewire\WithFileUploads;

class RecruitmentForm extends Component
{
    use WithFileUploads;

    public $first_name, $last_name, $email, $phone, $cv, $cover_letter;
    public $isSubmitted = false;

    protected $rules = [
        'first_name' => 'required|min:2',
        'last_name' => 'required|min:2',
        'email' => 'required|email',
        'phone' => 'required',
        'cv' => 'required|mimes:pdf|max:3072',
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

        // On bascule l'état du composant
        $this->isSubmitted = true;

        $this->reset(['first_name', 'last_name', 'email', 'phone', 'cv', 'cover_letter']);
    }

    public function render()
    {
        return view('livewire.recruitment-form');
    }
}
