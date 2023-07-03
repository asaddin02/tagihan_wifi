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
    /**
     * Menampilkan informasi tentang user yang login
     */
    public function index()
    {
        $user = User::find(Auth::user()->id);
        return view('profile.userprofile', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Menambah data Customer Service
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request, [
            'user_id' => ['required', 'number'],
            'name' => ['required', 'string'],
            'no_telepon' => ['required', 'number'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'string'],
            'role' => ['required'],
        ]);
        User::create([
            'user_id' => $validate['user_id'],
            'name' => $validate['name'],
            'no_telepon' => $validate['no_telepon'],
            'email' => $validate['email'],
            'password' => Hash::make($validate['password']),
            'role' => $validate['role'],
        ]);
        return redirect()->back();
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
            $validate = Validator::make($request->all(),[
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
}
