<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar el formulario de login
    public function showLoginForm()
    {
        return view('auth.login'); // Muestra la vista de login
    }

    // Función de login
    public function login(Request $request)
    {
        // Validar la entrada del usuario
        $request->validate([
            'usuario' => 'required|string',
            'password' => 'required|string',
        ]);

        // Intentar autenticar al usuario
        $user = User::where('usuario', $request->usuario)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Si es un administrador
            if ($user->rol === 'admin') {
                session(['user_id' => $user->id]);
                session(['user' => $user]);
                return redirect('/animes'); // Redirige al index de animes si es admin
            }

            // Si es un usuario regular
            if ($user->rol === 'usuario') {
                session(['user_id' => $user->id]);
                session(['user' => $user]);
                return redirect('/animes'); // Redirige a una vista de usuario
            }

            return back()->withErrors(['usuario' => 'El usuario no tiene un rol válido.']);
        }

        // Si las credenciales no son correctas
        return back()->withErrors(['usuario' => 'Credenciales incorrectas.']);
    }

    // Función de logout
    public function logout()
    {
        // Cerrar sesión y redirigir
        session()->forget('user');
        return redirect('/');
    }

    // Mostrar el formulario de registro
    public function showRegisterForm()
    {
        return view('auth.register'); // Muestra la vista de registro
    }

    // Registrar un nuevo usuario
    public function register(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'usuario' => 'required|string|unique:users',  // Asegúrate de que el usuario sea único
            'password' => 'required|string|confirmed|min:5', // Contraseña confirmada y con mínimo 8 caracteres
            'rol' => 'required|in:usuario,admin', // Validar que el rol sea uno de los dos posibles
        ]);

        // Crear el nuevo usuario
        $user = User::create([
            'usuario' => $request->usuario,
            'password' => Hash::make($request->password), // Cifra la contraseña usando bcrypt
            'rol' => $request->rol, // Guardamos el rol seleccionado
        ]);

        // Iniciar sesión automáticamente al registrar
        session(['user' => $user]);

        // Redirigir a la página de animes o a donde desees
        return redirect('/animes');
    }
}
