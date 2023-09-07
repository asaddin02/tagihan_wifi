<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    // Show Profile Page
    public function index()
    {
        $title = 'Halaman Profil';

        $user = User::find(Auth::user()->id);

        return view('profile.userprofile', compact('title', 'user'));
    }

    // Create User
    public function store(Request $request)
    {
        $checkId = User::where('user_id', $request->user_id)->first();
        $checkEmail = User::where('email', $request->email)->first();

        if (isset($checkId) && isset($checkEmail)) return redirect('installation')->with('error', 'User Id atau Email sudah ada!');

        $validate = $request->validate(
            [
                'user_id' => ['required', 'numeric', 'unique:users'],
                'name' => ['required', 'string', 'min:5', 'max:20'],
                'no_telepon' => ['required', 'numeric'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required'],
                'role' => ['required'],
            ],
            [
                'user_id.numeric' => 'Inputan harus berupa angka.',
                'user_id.unique' => 'User Id tersebut sudah ada.',
                'name.min' => 'Nama minimal :min karakter.',
                'email.unique' => 'Email tersebut sudah ada.',
            ]
        );

        $hash = Hash::make($validate['password']);
        $validate['password'] = $hash;
        $create = User::create($validate);

        if ($create) {
            $status = 'user_created';
            $message = true;
        } else {
            $status = 'error';
            $message = 'Isi data dengan benar!';
        }

        return redirect('installation')->with($status, $message);
    }

    // Update Photo
    public function photoUpdate(Request $request, $id)
    {
        $validate = $request->validate(
            [
                'photo_profile' => ['required', 'image', 'file', 'max:5000'],
            ],
            [
                'photo_profile.max' => 'File maksimal 5 MB.',
            ]
        );

        $user = User::find($id);

        $check = $user->photo_profile;

        if ($check != null && Storage::exists($check)) {
            Storage::delete($check);
        }

        $validate['photo_profile'] = $request->file('photo_profile')->store('profile');
        $update = $user->update($validate);

        if ($update) {
            $status = 'success';
            $message = 'Foto berhasil diupload!';
        } else {
            $status = 'error';
            $message = 'Foto gagal diupload!';
        }

        return back()->with($status, $message);
    }

    // Update Profile
    public function profileUpdate(Request $request, $id)
    {
        $validate = $request->validate(
            [
                'name' => ['required', 'string', 'min:10'],
                'email' => ['required', 'email'],
                'no_telepon' => ['required', 'min:8'],
            ],
            [
                'name.min' => 'Nama minimal :min karakter.',
                'email.email' => 'Masukkan email dengan benar.',
                'no_telepon.min' => 'Nomor minimal :min karakter.',
            ]
        );

        $user = User::find($id);
        $checkEmailPhone = User::where('email', $request->email)->where('no_telepon', $request->no_telepon)->first();

        if (isset($checkEmailPhone)) {
            if ($id == $checkEmailPhone->id) {
                $user->update($validate);
                return back()->with('success', 'Data berhasil diupdate.');
            }
        }

        return back()->with('error', 'Email atau Nomor sudah digunakan.');
    }

    // Update Password
    public function passwordUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'old_password' => ['required'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ],
            [
                'password.min' => 'Password minimal :min karakter.',
                'password.confirmed' => 'Password tidak cocok.',
            ]
        );

        $user = User::find($id);
        $checkOldPass = Hash::check($request->old_password, $user->password);

        if ($checkOldPass == false) return back()->with('error', 'Password lama anda salah!');

        $user->update([
            'password' => Hash::make($request->password),
        ]);

        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('login')->with('success', 'Password berhasil diupdate, silahkan login kembali.');
    }

    // Login
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate(
            [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ],
            [
                'email.email' => 'Masukkan email dengan benar.',
            ]
        );

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/')->with('success', 'Selamat datang.');
        }

        return back()->with('error', 'Pastikan email dan password benar');
    }

    // Logout
    public function logout(): RedirectResponse
    {
        Auth::logout();

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect('login')->with('success', 'Log Out berhasil.');
    }
}
