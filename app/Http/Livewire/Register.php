<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;


class Register extends Component
{
    public  $name;
    public  $email;
    public $password;

    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|min:10',
        'password' => 'required|min:6'
    ];
    //custome message
    protected $messages = [
        'name.required' => 'le champ nom est obligatoire.',
        'name.min' => 'le champ doit étres 6 caractére au min.',
        'email.required' => 'le champ email est obligatoire.',
        'email.min' => 'le champ doit étres 6 caractére au min.',
    ];
    public function mount()
    {
        if (auth()->check()) {
             redirect("/");
        }
    }
    public function register()
    {
        $this->validate();
        $user = new User();
        $user->name = $this->name;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->save();
        $this->name = "";
        $this->email = "";
        $this->password = "";
        session()->flash('message', 'user successfully added.');
    }
    public function render()
    {
        return view('livewire.register');
    }
}
