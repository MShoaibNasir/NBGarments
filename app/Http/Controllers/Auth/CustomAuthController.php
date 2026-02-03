<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ConfirmsPasswords;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;


class CustomAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('show.dashboard');
        }
        return view('dashboard.auth.login');
    }
    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            // ✅ Success
            return redirect()->route('show.dashboard')->with('success', 'Login successful! Welcome back.');
        } else {
            // ❌ Error
            return back()->with('error', 'Invalid email or password. Please try again.');
        }
    }

    public function customLogout(Request $request)
    {
        Auth::logout();
        return redirect()->route('show.login')->with('success', 'You have been logged out successfully!');
    }
    public function editProfile(Request $request, $id)
    {
        $user = User::find($id);
        return view('dashboard.auth.edit', ['user' => $user]);
    }
    public function userUpdate(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            // ✅ Validate inputs
            $request->validate([
                'name' => 'string|max:255',
                'password' => 'nullable|min:6',
                'profile' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // ✅ Update name
            if ($request->filled('name')) {
                $user->name = $request->name;
            }

            // ✅ Update password (only if entered)
            if (!empty($request->password)) {
                $user->password = Hash::make($request->password);
            }

            // ✅ Handle profile image
            if ($request->hasFile('profile')) {
                // Delete old image if exists
                $oldImagePath = public_path('profile_images/' . $user->profile);
                if ($user->profile && file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }

                // Save new image
                $file = $request->file('profile');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('profile_images'), $fileName);

                // Save filename to DB
                $user->profile = $fileName;
            }


            $user->save();

            return redirect()->back()->with('success', 'Profile updated successfully.');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'User not found.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            // For unexpected errors
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
