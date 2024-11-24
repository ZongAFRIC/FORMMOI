<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta & CSS inclusion -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Inscription">
    <meta name="author" content="Educa">
    <title>Educa - Inscription</title>
    <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900" rel="stylesheet">
    <link href="{{asset('css/sb-admin-2.min.css')}}" rel="stylesheet">
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

    <div class="d-flex justify-content-center">
        <ul class="list-inline">
            <li class="list-inline-item me-6 " style="color: white">Vous inscrire en tant qu'étudiant</li>
            <li class="list-inline-item ml-4 fs-4">
                <a href="#formateur" style="color: white">Vous inscrire en tant que formateur</a>
            </li>
        </ul>
    </div>

    <div class="container">

        <!-- Formulaire d'inscription étudiant -->
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image card mt-3">
                        <img src="{{ asset('img/etudiant.jpg') }}" alt="étudiant" class="img-fluid">
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">M'inscrire en tant qu'étudiant</h1>
                            </div>
                            <form class="user" action="{{ route('registerEtudiant')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="role" value="etudiant">

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="nom">Nom</label>
                                        <input type="text" class="form-control form-control-user" placeholder="Nom" name="nom" :value="old('nom')" required autofocus autocomplete="nom">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="prenom">Prenom</label>
                                        <input type="text" class="form-control form-control-user" placeholder="Prénom" name="prenom" :value="old('prenom')" required autofocus autocomplete="prenom">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="telephone">Telephone</label>
                                        <input type="text" class="form-control form-control-user" placeholder="Téléphone" name="telephone" :value="old('telephone')" required autofocus autocomplete="telephone">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="image">Photo</label>
                                        <input type="file" class="form-control form-control-lg" name="image"  autofocus autocomplete="image" accept="image/*">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control form-control-user" placeholder="Adresse e-mail" name="email" :value="old('email')" required autofocus autocomplete="email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="password">Mot de passe</label>
                                        <input type="password" class="form-control form-control-user" placeholder="Mot de passe" name="password" required autocomplete="new-password">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="password">Confirmation mot de passe</label>
                                        <input type="password" class="form-control form-control-user" placeholder="Confirmer mot de passe" name="password_confirmation" required autocomplete="new-password">
                                        {{-- <input-error :messages="$errors->get('password_confirmation')" class="mt-2" /> --}}
                                    </div>
                                </div>

                                <button class="btn btn-primary btn-user btn-block">M'inscrire</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a href="{{route('login')}}">J'ai déjà un compte ? Me connecter !</a>
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
                    <div class="col-lg-5 d-none d-lg-block bg-register-image mt-4">
                        <img src="{{ asset('img/formateur.jpg') }}" alt="formateur" class="img-fluid mt-4">
                    </div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">M'inscrire en tant que formateur</h1>
                            </div>
                            <form class="user" action="{{ route('registerFormateur')}}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="role" value="formateur">

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="nom">Nom</label>
                                        <input type="text" class="form-control form-control-user" placeholder="Nom" name="nom" :value="old('nom')" required autofocus autocomplete="nom">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="nom">Prenom</label>
                                        <input type="text" class="form-control form-control-user" placeholder="Prénom" name="prenom" :value="old('prenom')" required autofocus autocomplete="prenom">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="nom">Telephone</label>
                                        <input type="text" class="form-control form-control-user" placeholder="Téléphone" name="telephone" :value="old('telephone')" required autofocus autocomplete="telephone">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="nom">Image</label>
                                        <input type="file" class="form-control form-control-lg" name="image" accept="image/*">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="nom">Email</label>
                                    <input type="email" class="form-control form-control-user" placeholder="Adresse e-mail" name="email" required autofocus autocomplete="email">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="nom">Attestation</label>
                                        <input type="file" class="form-control form-control-lg" placeholder="Attestation" name="attestation" required autofocus autocomplete="attestation">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="nom">Cv</label>
                                        <input type="file" class="form-control form-control-lg" placeholder="CV" name="cv" required autofocus autocomplete="cv">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <label for="nom">Mot de passe</label>
                                        <input type="password" class="form-control form-control-user" placeholder="Mot de passe" name="password" required autocomplete="new-password">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="nom">Mot de passe confirmation</label>
                                        <input type="password" class="form-control form-control-user" placeholder="Confirmer mot de passe" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                </div>
                                <label for="nom">Biographie</label>
                                <textarea name="bio" for="description" cols="66" rows="1" class="form-control form-control-user mb-2" :value="old('bio')" autofocus autocomplete="bio" placeholder="Bio"></textarea>
                                <button class="btn btn-primary btn-user btn-block">M'inscrire</button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a href="{{route('login')}}#formateur">J'ai déjà un compte ? Me connecter !</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>
</html>
