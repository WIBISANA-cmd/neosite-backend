<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        return User::whereIn('role', ['admin', 'superadmin', 'content'])
            ->orderBy('name')
            ->paginate(20);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'in:admin,superadmin,content'],
        ]);

        $data['password'] = Hash::make($data['password']);

        return User::create($data);
    }

    public function update(Request $request, User $adminUser)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,'.$adminUser->id],
            'password' => ['nullable', 'string', 'min:8'],
            'role' => ['required', 'in:admin,superadmin,content'],
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $adminUser->update($data);

        return $adminUser;
    }

    public function destroy(User $adminUser)
    {
        $adminUser->delete();
        return response()->noContent();
    }
}
