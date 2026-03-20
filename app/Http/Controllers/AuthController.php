<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function logout()
    {
        echo 'logout';
    }

    public function loginSubmit(Request $request)
    {
        //form validation
        $request->validate(
            ['text_username' => 'required|email',
            'text_password' => 'required|min:6|max:16'
            ],
            [
                'text_username.required' => 'O username é obrigatorio',
                'text_username.email' => 'O username deve ser um email válido',
                'text_password.required' => 'A password é obrigatória',
                'text_password.min' => 'A password deve ter pelo menos :min caracteres',
                'text_password.max' => 'A password deve ter pelo menos :max caracteres'
            ]
        );

        //get user input
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        echo 'OK';
    }

}
