<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Menampilkan halaman register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses registrasi pengguna
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|confirmed',
            'username' => 'required|string|unique:users|max:255', // Tambahkan validasi username
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username, // Tambahkan username
            'password' => Hash::make($request->password),
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    // Proses login dengan email & password
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    // Redirect ke Google untuk login
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Callback dari Google setelah login berhasil
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Cek apakah pengguna sudah ada di database
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Buat user baru dengan username dari email
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'username' => $this->generateUsername($googleUser->getEmail()), // Generate username
                    'password' => Hash::make(uniqid()), // Password acak
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar(),
                ]);
            } else {
                // Update Google ID jika user sudah ada tapi belum terkait dengan Google
                $user->update([
                    'google_id' => $googleUser->getId(),
                    'avatar' => $googleUser->getAvatar()
                ]);
            }

            Auth::login($user);
            return redirect('/dashboard');
            
        } catch (Exception $e) {
            return redirect('/login')->with('error', 'Google login failed: ' . $e->getMessage());
        }
    }
    
    /**
     * Generate username from email
     */
    private function generateUsername($email)
    {
        // Ambil username dari bagian email sebelum @
        $username = explode('@', $email)[0];
        
        // Cek apakah username sudah digunakan
        $count = User::where('username', 'LIKE', $username . '%')->count();
        
        // Jika sudah digunakan, tambahkan angka dibelakangnya
        return ($count > 0) ? $username . ($count + 1) : $username;
    }

    // Logout pengguna
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}