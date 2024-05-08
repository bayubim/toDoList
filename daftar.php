<?php
session_start();
if (isset($_SESSION['login'])) {
    header("location: listAktivitas.php");
}
?>
<html>

<head>
    <title>Form Daftar</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <style>
    body {
        height: 100%;
    }

    .background-radial-gradient {
        background-image: linear-gradient(109.6deg, rgba(156, 252, 248, 1) 11.2%, rgba(110, 123, 251, 1) 91.1%);
        height: 100%;
    }

    .card {
        box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
    }
    </style>
</head>

<body>
    <form action="aksiDaftar.php" method="POST">
        <div class="background-radial-gradient">
            <div class="container">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-lg-12 col-xl-11">
                        <div class="card text-black" style="border-radius: 25px;">
                            <div class="card-body p-md-5">
                                <div class="row align-items-center justify-content-center">
                                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                        <p class="text-center h2 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up for a new
                                            account</p>
                                        <form class="mx-1 mx-md-4">

                                            <div class="d-flex flex-row align-items-center mb-4 position-relative">
                                                <div class="flex-fill mb-0">
                                                    <input class="form-control" placeholder="Username" type="text"
                                                        name="username" />
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4 position-relative">
                                                <div class="flex-fill mb-0">
                                                    <input class="form-control" placeholder="Email" type="email"
                                                        name="email" />
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="flex-fill mb-0">
                                                    <input class="form-control" placeholder="Password" type="password"
                                                        name="password">
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <div class="flex-fill mb-0">
                                                    <input class="form-control" placeholder="Confirm Password"
                                                        type="password" name="confirm_password">
                                                </div>
                                            </div>

                                            <div class="d-flex justify-content-center mb-3 mb-lg-4">
                                                <button type="submit" class="btn btn-primary px-5 btn-block mb-4">Sign
                                                    Up</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div
                                        class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                        <img src="img/gambarlogin.jpg" class="img-fluid" alt="Sample image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="alert.js"></script>
</body>

</html>