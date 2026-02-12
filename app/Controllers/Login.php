<?php

    use App\Controllers\BaseController;

    class Login extends BaseController
    {

        public function auth()
        {

            $username = $this->request->getPost("username");
            $password = $this->request->getPost("password");
            
            $rules = [
                "username" => $username,
                "password" => $password
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput();
            }

            $userModel = new Users();
            $user = $userModel->where("username", $username)->first();

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

            return redirect()->to("/users");

        }

    }