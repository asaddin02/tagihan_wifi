<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    // Membaca data tabel
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('profile.userprofile', compact('user'));
    }

    // Menambahkan data tabel
    public function store(Request $request)
    {
        $checkId = User::where('user_id', $request->user_id)->first();
        $checkEmail = User::where('email', $request->email)->first();

        if (isset($checkId)) {
            $status = 'error';
            $message = 'User id tersebut sudah ada!';
        } elseif (isset($checkEmail)) {
            $status = 'error';
            $message = 'Email tersebut sudah ada!';
        } else {
            $validate = $request->validate([
                'user_id' => ['required'],
                'name' => ['required'],
                'no_telepon' => ['required', 'numeric'],
                'email' => ['required', 'email', 'unique:users'],
                'password' => ['required'],
                'role' => ['required'],
            ]);

            $hash = Hash::make($validate['password']);
            $validate['password'] = $hash;
            $create = User::create($validate);

            if ($create) {
                $status = 'user_created';
                $message = true;
            } else {
                $status = 'error';
                $message = 'Isi data user dengan benar!';
            }
        }

        return redirect('installation')->with($status, $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update data user yang login
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if ($request->file('photo_profile')) {
            // Update gambar
            $gambar = $request->validate([
                'file' => 'required|mimes:jpg,png,jpeg|max:5120'
            ], [
                'file.required' => 'tidak ada foto yang diunggah',
                'file.mimes' => 'format foto harus jpg,png atau jpeg',
                'file.max' => 'ukuran maksimal 5MB'
            ]);
            $user['photo_profile'] = Storage::put('photo_profile', $gambar);
            $user['photo_profile']->update($gambar);
        } elseif ($request->input('password')) {
            // Update password
            $validate = Validator::make($request->all(), [
                'password' => ['required', 'confirmed'],
            ]);
            if ($validate->fails()) {
                dd($validate);
                return redirect()->back();
            }
            $user->update([
                'password' => Hash::make($request->input('password'))
            ]);
            session()->flush();
            return redirect('login');
        } else {
            // Update data normal
            $validate = Validator::make($request->all(), [
                'name' => ['required', 'string'],
                'email' => ['required', 'string', 'email', 'unique:users'],
                'no_telepon' => ['required', 'numeric'],
            ]);
            if ($validate->fails()) {
                return redirect()->back();
            }
            $user->update($request->all());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Login User
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/')->with('success', 'Selamat datang');
        }
        return back()->with('error', 'Pastikan email dan password benar');
    }

    public function logout()
    {
        session()->flush();
        return redirect('login');
    }
}
