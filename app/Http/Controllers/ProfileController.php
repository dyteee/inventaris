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
        $user = $request->user();
        $recentLogs = \App\Models\ActivityLog::where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        $stats = [
            'total_loans' => \App\Models\Loan::where('user_id', $user->id)->count(),
            'active_loans' => \App\Models\Loan::where('user_id', $user->id)->where('status', 'dipinjam')->count(),
            'total_all_items' => \App\Models\Item::count(),
            'total_all_loans' => \App\Models\Loan::count(),
        ];

        return view('profile.edit', [
            'user' => $user,
            'recentLogs' => $recentLogs,
            'stats' => $stats,
        ]);
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

        return Redirect::route('profile.edit')->with('success', 'Informasi profil Anda berhasil diperbarui!');
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
