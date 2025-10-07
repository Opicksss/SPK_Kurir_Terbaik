<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function profile($id)
    {
        $user = User::findOrFail($id);
        return view('profile.profile', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        try {
            $request->validate([
                'current_password' => ['required'],
                'new_password' => ['required', 'min:6', 'confirmed'],
            ]);

            $user = User::findOrFail(Auth::id());

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->with('error', 'Password lama salah');
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return back()->with('success', 'Password berhasil diperbarui');
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi kesalahan saat mengubah password. Silakan coba lagi.');
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
            ]);

            $user = User::findOrFail(Auth::id());
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            return redirect()->back()->with('success', 'Profile berhasil diupdate');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupdate Profile. Silakan coba lagi.');
        }
    }
}
