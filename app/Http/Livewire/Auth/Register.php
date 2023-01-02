<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Register extends Component
{
    public $data=[
        "firstname"=> "",
        "lastname"=> "",
        "email"=> "",
        "password"=> "",
        "password_confirmation"=> ""
    ];
    public function handelRegister(){
        $this->validate([
            'data.firstname' => 'required',
            'data.lastname' => 'required',
            'data.email' => 'required |email',
            'data.password' => 'required |string | min:6 | confirmed',
        ]);

        $link= "<a href='/login'>وارد</a>";
        if(User::where('email', '=', $this->data['email'])->exists()){
            Session::flash('message', ' ایمیل تکراری .لطفا'.$link.' شوید.'); 
        }else{
            $user =new User;
            $user->firstname= $this->data['firstname'];
            $user->lastname= $this->data['lastname'];
            $user->email= $this->data['email'];
            $user->password=Hash::make($this->data['password']);
            $user->save();
    
            $id=$user->id;
            Auth::loginUsingId($id);
            return redirect()->route('user.panel');
            
        }


    }
    public function render()
    {
        return view('livewire.auth.register');
    }
}
