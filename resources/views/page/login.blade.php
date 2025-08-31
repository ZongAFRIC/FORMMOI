<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta & CSS inclusion -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Inscription">
    <meta name="author" content="Educa">
    <title>Educa - Connexion</title>
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

<body class="bg-gradient-primary">

    <div class="d-flex justify-content-center ">
        <ul class="list-inline mt-2">
            <li class="list-inline-item me-6 fs-3">
                <a href="#etudiant" class="btn bg-white text-gray-900">Je suis étudiant</a>
            </li>
            <li class="list-inline-item ml-4 fs-3">
                <a href="#formateur" class="btn bg-white text-gray-900">Je suis formateur</a>
            </li>
        </ul>
    </div>

    <div class="container">

        <!-- Formulaire d'inscription étudiant -->
        <div class="card o-hidden border-0 shadow-lg my-5" id="etudiant">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-register-image card mt-2">
                        <img src="{{ asset('img/etudiant.jpg') }}" alt="étudiant" class="img-fluid">
                    </div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Me connecter en tant qu'étudiant</h1>
                            </div>
                            <form class="user" action="{{ route('loginEtudiant')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="role" value="etudiant">

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control " placeholder="Adresse e-mail" name="email" required autofocus autocomplete="email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Mot de passe</label>
                                    <input type="password" class="form-control " placeholder="Mot de passe" name="password" required autocomplete="new-password">
                                </div>

                                <button class="btn btn-primary btn-user btn-block fs-4">Connexion</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a href="#">Mot de passe oublié!</a>
                            </div>
                            <hr>
                            <div class="text-center">
                                <a href="{{route('register')}}">Je n'ai pas un compte ? M'inscrire !</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<!-- ************************* Formulaire d'inscription formateur *********************************** -->
        <div class="card o-hidden border-0 shadow-lg my-5" id="formateur">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-register-image mt-4">
                        <img src="{{ asset('img/formateur.jpg') }}" alt="formateur" class="img-fluid mt-4">
                    </div>
                    <div class="col-lg-6">
                        <a href="#etudiant" class="btn btn-primary"> Je suis etutiant</a>
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Je suis un formateur</h1>
                            </div>
                            
                                @if(session('error'))
                                    <div class="alert alert-danger card text-center">
                                        {{ session('error') }}
                                        Veuillez patienter!
                                    </div>
                                @endif
                            

                            <form class="user" action="{{ route('loginFormateur')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="role" value="formateur">

                                <div class="form-group">
                                    <label for="email"> E-mail </label>
                                    <input type="email" class="form-control " placeholder="Adresse e-mail" name="email" required autocomplete="email">
                                </div>
                                <div class="form-group">
                                    
                                    <label for="password"> Mot de passe </label>
                                    <input type="password" class="form-control " placeholder="Mot de passe" name="password" required autocomplete="new-password">
                                </div>
                                <button class="btn btn-primary btn-user btn-block fs-4">Connexion</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a href="#">Mot de passe oublié!</a>
                            </div>
                            <hr>
                            <div class="text-center">
                                <a href="{{route('register')}}#formateur">Je n'ai pas un compte ? M'inscrire !</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
