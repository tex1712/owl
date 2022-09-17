<?php
 
namespace App\Http\Controllers\Auth;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Models\User;
 
class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended(route('dashboard'));
        }
 
        return back()->withErrors([
            'email' => 'Невірний логін чи пароль.',
        ])->onlyInput('email');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}