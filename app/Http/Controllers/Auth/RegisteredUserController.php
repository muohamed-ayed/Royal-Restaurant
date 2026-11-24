<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register', ['isFirstRegistration' => !DB::table('restaurant_settings')->where('id', 1)->value('admin_created')]);
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = DB::transaction(function () use ($request) {
            $settings = DB::table('restaurant_settings')->where('id', 1)->lockForUpdate()->first();
            if (!$settings) {
                DB::table('restaurant_settings')->insert(['id' => 1, 'admin_created' => false, 'created_at' => now(), 'updated_at' => now()]);
                $settings = (object) ['admin_created' => false];
            }

            $role = $settings->admin_created ? 'user' : 'admin';

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            $user->forceFill(['role' => $role])->save();

            if ($role === 'admin') {
                DB::table('restaurant_settings')->where('id', 1)->update(['admin_created' => true, 'updated_at' => now()]);
            }

            return $user;
        });

        event(new Registered($user));
        Auth::login($user);

        return $user->isAdmin()
            ? redirect()->route('dashboard')
            : redirect()->route('home')->with('success', 'Your account has been created. Welcome!');
    }
}
