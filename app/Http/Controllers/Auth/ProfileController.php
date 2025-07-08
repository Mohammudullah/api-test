<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Auth\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show()
    {
        return new UserResource(Auth::user());
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'profile_picture' => 'sometimes|image|max:2048', // Assuming you want to allow profile picture updates
        ]);

        $user->update([
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'profile_picture' => $request->profile_picture ? $request->file('profile_picture')->store('profile_pictures', [
                'disk' => 'public',
            ]) : $user->profile_picture,
        ]);

        return new UserResource($user);
    }
}
