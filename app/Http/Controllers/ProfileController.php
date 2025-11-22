<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Show post-registration profile setup form.
     */
    public function setup(Request $request): View
    {
        return view('profile-setup', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Store profile setup data.
     */
    public function storeSetup(Request $request)
    {
        $user = $request->user();

        $request->validate([
            'usuario' => ['required', 'string', 'max:50'],
            'nombre' => ['required', 'string', 'max:50'],
            'apellido1' => ['nullable', 'string', 'max:50'],
            'apellido2' => ['nullable', 'string', 'max:50'],
            'fecha_nacimiento' => ['nullable', 'date'],
            'bio' => ['nullable', 'string', 'max:1000'],
            'location' => ['nullable', 'string', 'max:255'],
            'website' => ['nullable', 'url', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        // Update known fields that are safe to write
        $user->usuario = $request->input('usuario', $user->usuario);
        $user->nombre = $request->input('nombre', $user->nombre);
        $user->apellido1 = $request->input('apellido1', $user->apellido1);
        $user->apellido2 = $request->input('apellido2', $user->apellido2);
        $user->fecha_nacimiento = $request->input('fecha_nacimiento', $user->fecha_nacimiento);

        if (\Illuminate\Support\Facades\Schema::hasColumn($user->getTable(), 'bio')) {
            $user->bio = $request->input('bio');
        }

        if (\Illuminate\Support\Facades\Schema::hasColumn($user->getTable(), 'location')) {
            $user->location = $request->input('location');
        }

        if (\Illuminate\Support\Facades\Schema::hasColumn($user->getTable(), 'website')) {
            $user->website = $request->input('website');
        }

        // Avatar upload
        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $path = $request->file('avatar')->store('avatars', 'public');
            if (\Illuminate\Support\Facades\Schema::hasColumn($user->getTable(), 'avatar')) {
                $user->avatar = $path;
            }
        }

        $user->save();

        return redirect()->route('feed')->with('status', 'profile-setup-complete');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
