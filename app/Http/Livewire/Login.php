<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public  $email;
    public $password;

    protected $rules = [

        'email' => 'required|min:10',
        'password' => 'required|min:6'
    ];

    //custome message
    protected $messages = [
        'email.required' => 'le champ email est obligatoire.',
        'email.min' => 'le champ doit étres 6 caractére au min.',
    ];
    public function mount()  {
        if (auth()->check()) {
             redirect("/");
        }
    }
    public function login()
    {
     if(Auth::attempt(['email'=>$this->email,'password'=>$this->password])){

         session()->flash('message', 'user connected successfully .');
        return  redirect("/");
     }else{
            session()->flash('message', 'user not  connected.');
            return  redirect()->back();
     }
    }
    public function render()
    {
        return view('livewire.login');
    }
}
