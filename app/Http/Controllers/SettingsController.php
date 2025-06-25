<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SettingsController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('settings.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $request->validate([
            'name' => 'nullable|string|max:255',
        ]);
        $user->name = $request->name;
        $user->save();

        return redirect()->route('settings.edit')->with('status', 'Profile updated!');
    }
} 