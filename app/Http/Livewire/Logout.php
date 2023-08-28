<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Logout extends Component
{

    function logout() {
        auth()->logout();
         redirect('/auth');

    }
    public function render()
    {
        return view('livewire.logout');
    }
}
