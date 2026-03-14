<?php

namespace App\Controllers;
use App\Models\Users;
use InvalidArgumentException;

class Login extends BaseController
{

    public function index()
    {
        return view("index");
    }

    // --- RBAC AUTHENTICATION ---
    public function auth()
    {

        $username = $this->request->getPost("username");
        $password = $this->request->getPost("password");

        $rules = [
            "username" => "required",
            "password" => "required"
        ];

        try {

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput();
            }

            $userModel = new Users();
            $user = $userModel
                            ->select("users.userId, users.username, users.password, users.role")
                            ->join("ojt_students as ojs", "users.userId = ojs.userId", "left")
                            ->where("username", $username)
                            ->where("ojs.status", ACTIVE_STATUS)
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


            switch ($user["role"]) {
                case "ADMIN": {
                    return redirect()->to(site_url("admin/dashboard"));
                }
                case "OJT": {
                    return redirect()->to(site_url("students_ojt/mainview"));

                }
                default: {
                    throw new InvalidArgumentException("User not register, Invalid user!");
                }
            }

        } catch (\Throwable $th) {
            $th->getMessage();
        }

    }

}