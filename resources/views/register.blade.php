<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('template') }}/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('template') }}/css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .background {
            background-image: url('https://i.pinimg.com/originals/44/e1/52/44e152a6334b2ad5bffdcc3c469a6005.gif');
            background-repeat: no-repeat;
            background-size: cover;
        }

        @media only screen and (min-width: 600px) {
            #card-box {
                width: 60%;
                margin: 0 auto;
            }
        }
    </style>
</head>

<body class="background">

    <div class="container">
        <div class="card o-hidden border-0 shadow-lg my-5" id="card-box">
            <div class="p-5">
                <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                </div>
                <form method="POST" action="{{route('prosesRegiter')}}">
                    @csrf
                    <div class="form-group row">
                        <input type="text" name="name" class="form-control form-control-user"
                            id="exampleFirstName" placeholder="First Name">
                        @error('name')
                                <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <input type="email" name="email" class="form-control form-control-user"
                            id="exampleInputEmail" placeholder="Email Address">
                        @error('email')
                                <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <input type="password" name="password" class="form-control form-control-user"
                            id="exampleInputPassword" placeholder="Password">
                        @error('password')
                                <strong>{{ $message }}</strong>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Register
                    </button>
                </form>
                <hr>
                <div class="text-center">
                    <a class="small" href="{{ route('loginpage') }}">Already have an account? Login!</a>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('template') }}/vendor/jquery/jquery.min.js"></script>
    <script src="{{ asset('template') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('template') }}/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template') }}/js/sb-admin-2.min.js"></script>

</body>

</html>
