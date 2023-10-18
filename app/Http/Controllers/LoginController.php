<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
   public function index(){
    return \view('login.index');
   }

   public function authenticate(Request $request){
      $crediantials = $request->validate([
         'username' =>  ['required'],
         'password' => ['required']
      ]);

      if(Auth::attempt($crediantials)){
         $request->session()->regenerate();
         $request->session()->flash('login', $this->_ucapan());
         return redirect()->intended('dashboard');
      }
      return \back()->with('loginError','Login gagal!!');
   }

   public function logout(Request $request)
   {
       Auth::logout();
       $request->session()->invalidate();
       $request->session()->regenerateToken();
       return redirect('/');
   }

   private function _ucapan()
    {
        $currentHour = now()->hour; // Mendapatkan jam saat ini
        if ($currentHour >= 5 && $currentHour < 12) {
            $greeting = "Selamat pagi";
        } elseif ($currentHour >= 12 && $currentHour < 18) {
            $greeting = "Selamat siang";
        } else {
            $greeting = "Selamat malam";
        }
        return $greeting;
    }

}
