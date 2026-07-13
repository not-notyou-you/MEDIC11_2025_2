<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Service;
use App\Models\User;
use Illuminate\Validation\Rules;

class ProfileController extends Controller
{
    // Fungsi untuk mendapatkan notifikasi secara global
    private function getNotifications()
    {
        return [
            'notification' => Service::where('status', 'Pending')->get(),
            'pendings' => Service::where('status', 'Pending')->get()
        ];
    }

    public function index(): View
    {
        return view('profile.index', array_merge([
            'title' => 'Accounts',
            'accounts' => User::paginate(5),
        ], $this->getNotifications()));
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', array_merge([
            'user' => $request->user(),
            'title' => 'Profile',
        ], $this->getNotifications()));
    }

    /**
     * Show the form for creating a new user (admin only).
     */
    public function create(): View
    {
        return view('profile.create_admin', array_merge([
            'title' => 'Add New Account',
        ], $this->getNotifications()));
    }

    /**
     * Store a newly created user in storage (admin only).
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:users', 'ends_with:student.umn.ac.id'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
            'is_admin' => ['required', 'integer', 'in:0,1,2'], // Ubah validasi
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->is_admin,
        ]);

        return Redirect::route('profile.index')->with('status', 'Account has been created!');
    }

    /**
     * Display admin edit form for a user.
     */
    public function edit_admin($id): View
    {
        $user = User::findOrFail($id);

        return view('profile.edit_admin', array_merge([
            'user' => $user,
            'title' => $user->first_name,
        ], $this->getNotifications()));
    }

    /**
     * Update the user's own profile.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email', 'unique:users,email,' . $request->user()->id, 'ends_with:student.umn.ac.id'],
        ]);

        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'Your profile has been updated');
    }

    /**
     * Admin updates another user's profile.
     */
    public function update_admin(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id);
        
        // Cek jika user yang login adalah superadmin
        $currentUser = Auth::user();
        
        $request->validate([
            'email' => ['required', 'email', 'unique:users,email,' . $user->id, 'ends_with:umn.ac.id'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'status' => ['required', 'integer', 'in:0,1,2'], // Ubah validasi
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
                
        // **PERBAIKAN DI SINI: Gunakan constant ROLE_SUPERADMIN**
        // Jika bukan superadmin, tidak boleh membuat superadmin atau mengubah superadmin lain
        if ($currentUser->is_admin != User::ROLE_SUPERADMIN) {
            if ($request->status == User::ROLE_SUPERADMIN || $user->is_admin == User::ROLE_SUPERADMIN) {
                return back()->withErrors(['status' => 'Only superadmin can manage superadmin roles.']);
            }
        }

        $user->email = $request->email;
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->is_admin = $request->status;

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.index')->with('status', $user->first_name . ' has been updated!');
    }

    /**
     * Delete the authenticated user's own account.
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

    /**
     * Admin deletes another user's account.
     */
    public function destroy_admin($id): RedirectResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return Redirect::route('profile.index')->with('status', $user->first_name . ' has been deleted!');
    }

    public function password_update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }


}