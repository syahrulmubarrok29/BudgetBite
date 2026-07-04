<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminUserController extends Controller
{
    /**
     * List all users (exclude admins if needed, or list all).
     */
    public function index()
    {
        $users = User::select('id','name','email','role','created_at','password_changed_at')
            ->orderBy('created_at','desc')
            ->get()
            ->map(function ($u) {
                return [
                    'id'                  => $u->id,
                    'name'                => $u->name,
                    'email'               => $u->email,
                    'role'                => $u->role ?? 'user',
                    'created_at'          => $u->created_at,
                    'password_changed_at' => $u->password_changed_at,
                ];
            });

        return response()->json(['success' => true, 'data' => $users]);
    }

    /**
     * Update a user's name, email, and/or role.
     */
    public function update(Request $request, int $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'role'  => ['required', 'in:user,admin'],
        ]);

        $user->update($validated);

        return response()->json(['success' => true, 'message' => 'User berhasil diperbarui.', 'data' => $user]);
    }

    /**
     * Delete a user (prevent deleting yourself).
     */
    public function destroy(Request $request, int $id)
    {
        if ($request->user()->id === $id) {
            return response()->json(['success' => false, 'message' => 'Tidak bisa menghapus akun sendiri.'], 403);
        }

        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['success' => true, 'message' => 'User berhasil dihapus.']);
    }
}
