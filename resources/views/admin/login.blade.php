<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta & CSS inclusion -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Inscription">
    <meta name="author" content="Educa">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .bg-register-image {
            background-size: cover;
            background-position: center;
            padding: 5px;
        }
        .form-control-lg{
            border-radius: 50px;
        }
    </style>
</head>

<body class="bg-gradient-danger">

    {{-- <div class="d-flex">
        <ul>
           <li style="color: white">Je suis un etudiant</li>
           <li> <a href="#formateur" style="color: white">Je suis un formateur</a></li>
        </ul>
   </div> --}}

    <div class="container">

        <!-- Formulaire d'inscription étudiant -->
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-register-image card mt-3">
                        <img src="{{ asset('img/etudiant.jpg') }}" alt="étudiant" class="img-fluid">
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Connexion Admin </h1>
                            </div>
                            <form class="user" action="{{ route('adminLogin')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="role" value="admin">

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control form-control-user" placeholder="Adresse e-mail" name="email" required autofocus autocomplete="email">
                                </div>
                                <div class="form-group row">
                                    <label for="password">Mot de passe</label>
                                    <input type="password" class="form-control form-control-user" placeholder="Mot de passe" name="password" required autocomplete="new-password">
                                </div>

                                <button class="btn btn-primary btn-user btn-block">Connexion</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a href="#">Mot de passe oublié!</a>
                            </div>
                            <hr>
                            {{-- <div class="text-center">
                                <a href="{{route('register')}}">Je n'ai pas un compte ? M'inscrire !</a>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
