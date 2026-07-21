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
    public function edit()
    {
    $user = auth()->user();

    return view('account.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
    $request->validate([
        'user_name' => 'required|max:255',
        'email' => 'required|email',
        'name' => 'required|max:255',
        'name_kana' => 'required|max:255',
    ]);

    $user = auth()->user();

    $user->update([
        'user_name' => $request->user_name,
        'email' => $request->email,
        'name' => $request->name,
        'name_kana' => $request->name_kana,
    ]);

    return redirect()->route('mypage')
        ->with('success', 'アカウント情報を更新しました。');
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
