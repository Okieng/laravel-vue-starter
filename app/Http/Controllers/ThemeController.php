<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    /**
     * Update the user's theme settings.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'theme_settings' => 'required|array',
        ]);

        $user = Auth::user();
        if ($user) {
            $user->update(['theme_settings' => $validated['theme_settings']]);
            return back()->with('success', 'Theme updated successfully');
        }

        return back()->with('error', 'User not found');
    }
}
