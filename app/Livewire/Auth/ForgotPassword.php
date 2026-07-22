<?php

namespace App\Livewire\Auth;

use Livewire\Component;

class ForgotPassword extends Component
{
    public string $email = '';

    public function sendReset()
    {
        $this->validate(['email' => ['required', 'email']]);

        // Mail isn't configured in this template — acknowledge gracefully.
        session()->flash('status', 'If that email exists, a reset link is on its way.');
    }

    public function render()
    {
        return view('auth.forgot-password')->layout('components.layouts.guest', ['title' => 'Reset password']);
    }
}
