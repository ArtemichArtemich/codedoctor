<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Прямая проверка через попытку аутентификации
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            // Проверяем админа
            if (Auth::user()->is_admin) {
                return redirect()->intended('/admin/contacts');
            }
            
            // Если не админ - разлогиниваем
            Auth::logout();
            return back()->withErrors([
                'email' => 'У вас нет прав доступа к админ-панели.',
            ]);
        }

        // Если аутентификация не удалась
        return back()->withErrors([
            'email' => 'Предоставленные учетные данные не совпадают с нашими записями.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/');
    }

    public function register()
    {
        abort(404); // Или редирект на главную
    }
}