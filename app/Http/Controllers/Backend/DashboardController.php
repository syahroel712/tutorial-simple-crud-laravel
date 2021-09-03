<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Helper\JwtHelper;


class DashboardController extends Controller
{
    public function index()
    {
        return view('backend/pages/auth/login');
    }

    public function dashboard()
    {
        $active = 'home';
        return view('backend/pages/home',[
            'active' => $active
        ]);
    }

    public function aksiLogin(Request $request)
    {

        $user = DB::table('tb_user')
                ->where('user_email', '=', $request->email)
                ->first();
        
        if (!$user) {
            return back()->with("message", "Email Salah");
        }
        if (!Hash::check($request->password, $user->user_password)) {
            return back()->with("message", "Password Salah");
        }

        $token = JwtHelper::BuatToken([$user->user_nama,$user->user_email, $user->user_level,$user->user_id]);

        // masukan data login ke session
        $request->session()->put('user_id', $user->user_id);
        $request->session()->put('user_nama', $user->user_nama);    
        $request->session()->put('user_email', $user->user_email);
        $request->session()->put('user_level', $user->user_level);
        $request->session()->put('token', $token);

        // redirect ke halaman home
        return redirect('app-admin/dashboard')->with("pesan", "Selamat Datang " . session('user_nama'));        
    }

    public function register()
    {
        return view('backend/pages/auth/register');
    }

    public function aksiRegister(Request $request)
    {
        $nama = $request->name;
        $email = $request->email;
        $password = $request->password;
        $pwd = Hash::make($password);

        $cek = DB::table('tb_user')->where('user_email', '=', $email)->first();
        if ($cek != NULL) {
            return back()->with('message', 'email Sudah Terdaftar');
        } else {
            $data = array(
                'user_nama' => $nama,
                'user_email' => $email,
                'user_password' => $pwd,
                'user_level' => 'owner',
            );
            DB::table('tb_user')->insert($data);
            return redirect()
                ->route('login')
                ->with('pesan', 'Register Sukses');
        }
    }

    function logout(Request $request)
    {
        $request->session()->forget('user_nama');
        $request->session()->forget('user_email');
        $request->session()->forget('user_level');
        $request->session()->forget('user_id');
        $request->session()->forget('token');
        // redirect ke halaman home
        return redirect('login')->with("pesan", "Anda Sudah Logout");
    }
}