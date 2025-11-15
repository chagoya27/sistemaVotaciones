<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Role;

class RegisteredUserController extends Controller
{
    /**
     * Muestra la vista de registro
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Valida los campos del formulario de registro
     * en caso de que los campos pasen la verificación
     * se inserta un nuevo usuario en la BD
     * 
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        //validación de campos
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name1' => ['required', 'string', 'max:255'],
            'last_name2' => ['required', 'string', 'max:255'],
            'user_name' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        //creación de un nuevo usuario
        $user = User::create([
            'name' => $request->name,
            'last_name1' => $request->last_name1,
            'last_name2' => $request->last_name2,
            'user_name' => $request->user_name,
            'password' => Hash::make($request->password),
        ]);

        //al nuevo usuario creado se le asigna el rol de usuario normal
        $userRole = Role::where('name', 'usuario_normal')->first();
        $user->assignRole($userRole);

        event(new Registered($user));

        // se registra el login del usuario creado
        Auth::login($user);

        // retorna al dashboard
        return redirect(route('dashboard', absolute: false));
    }
}
