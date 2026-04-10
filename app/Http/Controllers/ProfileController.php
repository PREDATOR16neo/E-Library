<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function updateAvatar(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $user = Auth::user();

        // Hapus avatar lama kalau ada (selalu hapus sebelum upload baru)
        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        // Simpan avatar baru
        $path = $request->file('avatar')->store('avatars', 'public');

        // Update langsung pakai query agar tidak kena cache model
        \App\Models\User::where('id', $user->id)->update(['avatar' => $path]);

        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }

    public function removeAvatar()
    {
        $user = Auth::user();

        if ($user->avatar) {
            Storage::disk('public')->delete($user->avatar);
        }

        \App\Models\User::where('id', $user->id)->update(['avatar' => null]);

        return back()->with('success', 'Foto profil berhasil dihapus!');
    }
}