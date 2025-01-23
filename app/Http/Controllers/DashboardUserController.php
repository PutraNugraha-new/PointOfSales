<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class DashboardUserController extends Controller
{
    public function index()
    {
        return view('admin.users.index', [
            'title' => 'Users',
            'users' => User::all()
        ]);
    }

    public function create()
    {
        return view('admin.users.create', [
            'title' => 'Create User',
        ]);
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => [
                    'required',
                    'string',
                    'max:100',
                    'regex:/^[\p{L}\s]+$/u', // Support untuk karakter unicode
                ],
                'email' => [
                    'required',
                    'string',
                    'email:rfc,dns', // Validasi DNS
                    'max:100',
                    Rule::unique('users')->ignore($request->id),
                ],
                'usertype' => [
                    'required',
                    'string',
                    Rule::in(['admin', 'superadmin']),
                ],
                'password' => [
                    'required',
                    'string',
                    'min:8',
                    Password::min(8)
                        ->letters()
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                ],
            ]);
            $validatedData['password'] = Hash::make($validatedData['password']);

            User::create($validatedData);

            return redirect('/users')
                ->with('success', 'New Supplier has been added successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();
        }
    }

    public function destroy(User $user)
    {

        try {
            $user->delete();
            return redirect()->route('users.index')
                ->with('success', 'user berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('users.index')
                ->with('error', 'Gagal menghapus User');
        }
    }
}
