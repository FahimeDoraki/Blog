<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class Login extends Component
{

    public  $email, $password;

    public function handelLogin(){

        $validatedDate = $this->validate([
            'email' => 'required |email',
            'password' =>['required','string','regex:/^[a-zA-Z0-9\-0-9.,@#$%6$*!]+$/u'],
        ]);

        if(Auth::attempt(array('email' => $this->email, 'password' => $this->password))){
            if (auth()->user()->type == 'user') {
                return redirect()->route('user.panel');
            }else if (auth()->user()->type == 'admin') {
                return redirect()->route('admin.panel');
            }
        }

  

        $link= "<a href='/register'>ثبت نام</a>";
        if(User::where('email', '=', $this->email)->exists()){
            Session::flash('message', 'پسورد اشتباه است'); 
        }else{
            Session::flash('message', 'کاربر یافت نشد .لطفا برای '.$link.' کلیک نمایید.'); 
        }





    }

    public function render(){
        return view('livewire.auth.login');
    }

 
}
