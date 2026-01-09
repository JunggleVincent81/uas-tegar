<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
{
    return view('admin.users', [
        'users' => User::with('role')->get(),
        'roles' => Role::all(),
    ]);
}


    public function roles()
    {
        return Role::all();
    }

    public function updateRole(Request $request, $id)
{
    $request->validate([
        'role_id' => ['required', 'exists:roles,id']
    ]);

    $user = User::findOrFail($id);
    $user->update([
        'role_id' => $request->role_id
    ]);

    return redirect()
    ->back()
    ->with([
        'success' => 'Role user berhasil diperbarui.',
        'updated_user_id' => $user->id
    ]);
}

}
