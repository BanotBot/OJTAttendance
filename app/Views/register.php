<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OJT Attendance | Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        #credentials {
            color: blue;
        }
    </style>
</head>
<body>
    <main>
        <section>

            <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
                <div class="col-md-5">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white text-center">
                            <h4>OJT Attendance Register</h4>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo site_url("register/auth") ?>" method="POST">

                                <div class="form-group">    
                                    <label for="firstname">FirstName : </label>
                                    <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter your firstname" required>
                                </div>

                                <div class="form-group">
                                    <label for="username">MiddleName : </label>
                                    <input type="text" name="middlename" id="middlename" class="form-control" placeholder="Enter your middlename" required>
                                </div>

                                <div class="form-group">
                                    <label for="username">LastName : </label>
                                    <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter your lastname" required>
                                </div>

                                <div class="form-group">
                                    <label for="address">Address : </label>
                                    <input type="text" name="address" id="address" class="form-control" placeholder="Enter your address" required>
                                </div>

                                <div class="form-group">
                                    <label for="username">ContactNumber : </label>
                                    <input type="text" name="contactNumber" id="contactNumber" class="form-control" placeholder="Enter your contactNumber" required>
                                </div>

                                <div class="form-group">
                                    <label for="username">Username : </label>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" required>
                                </div>

                                <p id="credentials"><strong>Credentials</strong></p>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                                </div>

                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                                
                                <div class="text-center mt-3">
                                   Already have account ?  <a href="<?php echo site_url("/") ?>" class="small"><span><strong>Login</strong></span></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>