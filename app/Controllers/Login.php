<?php

    namespace App\Controllers;
    use App\Models\Users;

    class Login extends BaseController
    {

        public function index() 
        {
            return view("Login");
        }

        public function auth()
        {

            $username = $this->request->getPost("username");
            $password = $this->request->getPost("password");

            $rules = [
                "username" => "required",
                "password" => "required"
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput();
            }

            $userModel = new Users();
            $user = $userModel
                    ->select("userId, username, password")
                    ->where("username", $username)
                    ->first();

                
            if (!$user) {
                return redirect()->back()->with("error", "No user found in this username!");
            }

            if ($password !== $user["password"]) {
                return redirect()->back()->with("error", "Wrong password");
            }

            session()->set([
                "userId" => $user["userId"],
                "username" => $user["username"]
            ]);

            $userModel->select([
                "username" => $username,
                "password" => $password
            ]);

            return redirect()->to(site_url("students_ojt/mainview"));

        }

    }