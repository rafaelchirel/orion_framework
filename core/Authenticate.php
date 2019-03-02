<?php

namespace Core;

use App\Models\User;

trait Authenticate {

	public function login()
    {
        $this->setPageTitle('Login');
        return $this->renderView('user/login', 'layout');
    }

    public function auth($request)
    {
        $data = [
            'email'    => $request->post->email,
            'password' => $request->post->password
        ];

        if (Validator::make($data, $this->user->rulesAuth())) 
            return Redirect::route("/login");

        $result = User::where('email', $request->post->email)->first();

        if($result && password_verify($request->post->password, $result->password)){
            $user = [
                'id'    => $result->id,
                'name'  => $result->name,
                'email' => $result->email
            ];
            Session::set('user', $user);
            return Redirect::route('/');
        }

        return Redirect::route('/login', [
            'errors' => ['Usuario o contraseña incorrecta.'],
            'inputs' => ['email' => $request->post->email]
        ]);
    }

    public function logout()
    {
        Session::destroy('user');
        return Redirect::route('/login');
    }
}