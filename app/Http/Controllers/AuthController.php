<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //login page
    public function login()
    {
        return view('login');
    }

    public function loginSubmit(Request $request)
    {
        //form validation
        $request->validate(
            [
                //Validation Rules
                'text_username' => 'required|email',
                'text_password' => 'required|min:6|max:16'
            ],
            [
                //Personalized Messages
                'text_username.required' => 'O username é obrigatorio',
                'text_username.email' => 'O username deve ser um email válido',
                'text_password.required' => 'A password é obrigatória',
                'text_password.min' => 'A password deve ter pelo menos :min caracteres',
                'text_password.max' => 'A password deve ter no máximo :max caracteres'
            ]
        );

        //get user input
        $username = $request->input('text_username');
        $password = $request->input('text_password');

        //checking if the user exists
        $user = User::where('username', $username)->where('deleted_at', NULL)->first();

        //the same as this in SQL.
        /*SELECT * FROM users
        WHERE username = 'valor_da_variavel'
        AND deleted_at IS NULL
        LIMIT 1;*/


        if (!$user) {
            return redirect()->back()->withInput()->with('loginError', 'Username ou Password incorretos');
        }

        //checking if the password matches the database
        if (!password_verify($password, $user->password)) {
            return redirect()->back()->withInput()->with('loginError', 'Username ou Password incorretos');
        }

        //saving the last login to the user's database
        $user->last_login = date('Y-m-d H:i:s');
        $user->save();

        //saving user data in the session
        session([
            'user' => [
                'id' => $user->id,
                'username' => $user->username,
            ]
        ]);

        return redirect()->to('/');

    }

    public function logout()
    {
        //deleted user data in the session
        session()->forget('user');
        return redirect()->to('/login');
    }

}
