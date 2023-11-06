<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(): Response
    {
        return response()->view('user.login', [
            'title' => 'Login'
        ]);
    }

    public function doLogin(Request $request): Response|RedirectResponse
    {
        $username = $request->post('username');
        $password = $request->post('password');

        //cek input kosong atau tidak
        if (empty($username) || empty($password)) {
            return response()->view('user.login', [
                'title' => 'Login',
                'error' => 'Username atau password dilarang kosong!',
                'username' => $username,
                'password' => $password
            ]);
        }

        //cek login true atau false
        if ($this->userService->login($username, $password)) {
            $request->session()->put('username', $username);

            return redirect('/');
        }

        //kalau user / password salah
        return response()->view('user.login', [
            'title' => 'Login',
            'error' => 'Username atau password salah!',
            'username' => $username,
            'password' => $password
        ]);
    }

    public function doLogout(Request $request)
    {
        $request->session()->forget('username');

        return redirect('/');
    }
}
