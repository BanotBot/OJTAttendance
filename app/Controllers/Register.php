<?php

    namespace App\Controllers;

    use App\Models\OjtStudents;
    use App\Models\Users;

    class Register extends BaseController
    {
        public function index()
        {
            return view("register");
        }

        public function auth()
        {

            $firstName = $this->request->getPost("firstName");
            $middleName = $this->request->getPost("middleName");
            $lastName = $this->request->getPost("lastName");
            $address = $this->request->getPost("address");
            $contactNumber = $this->request->getPost("contactNumber");
            $username = $this->request->getPost("username");
            $password = $this->request->getPost("password");

            $usersModel = new Users();
            $ojtStudentsModel = new OjtStudents();

            $rules = [
                "username" => "required",
                "password" => "required",
                "firstName" => "required",
                "middleName" => "required",
                "lastName" => "required",
                "address" => "required",
                "contactNumber" => "required"
            ];

            if (!$this->validate($rules)) {
                dd($this->validator->getErrors());
                return redirect()->back()->withInput();
            }

            $usersModel->insert([
                "username" => $username,
                "password" => $password
            ]);

            $userId = $usersModel->getInsertID();
            $ojtStudentsModel->insert([
                "userId" => $userId,
                "firstName" => $firstName,
                "middleName" => $middleName,
                "lastName" => $lastName,
                "address" => $address,
                "contactNumber" => $contactNumber,
                "status" => OjtStudents::STATUS_ACTIVE
            ]);

            return redirect()->to(site_url("/"));
        }
    }