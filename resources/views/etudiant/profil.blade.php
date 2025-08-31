@extends('layout.appEtudiant')
@section('content')

        <ol class="breadcrumb breadcrumb-chevron bg-body-tertiary rounded-3 mb-2">
            {{-- <li class="breadcrumb-item fs-5"><a href=" {{ route('etudiant.dashboard') }} ">Dashboard</a></li> --}}
            <li class="breadcrumb-item fs-5 ">Mon profil</li>
        </ol>
        <div class="card mb-2"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="card shadow-lg border-0 rounded-lg mt-2">
                        <div class="d-flex justify-content-center">
                                <img class="img-profile rounded-circle text-align-center" width="100" src="{{ auth()->guard('etudiant')->user()->image ? asset('storage/' . auth()->guard('etudiant')->user()->image) : asset('img/user-removebg-preview.png') }}" data-bs-toggle="modal" data-bs-target="#imageModal">
                            </div>
                        <div class="card-body">
                            
                            <table class="table p-3">
                                <tr>
                                    <td>Nom</td>
                                    <td class="text-end">{{ old('nom', auth()->guard('etudiant')->user()->nom) }}</td>
                                </tr>
                                <tr>
                                    <td>Prénom</td>
                                    <td class="text-end">{{ old('prenom', auth()->guard('etudiant')->user()->prenom) }}</td>
                                </tr>
                                <tr>
                                    <td>Téléphone</td>
                                    <td class="text-end">{{ old('telephone', auth()->guard('etudiant')->user()->telephone) }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td class="text-end">{{ old('email', auth()->guard('etudiant')->user()->email) }}</td>
                                </tr>
                            </table>
                            <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                                <a href="{{ route('profil.edit' , auth()->guard('etudiant')->user()->id )}}" class="btn btn-primary">Modifier mon profil</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
{{-- modal aggrandissement image --}}
    <div class="modal fade" id="imageModal" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">Ma photo de profil</div>
                <div class="modal-body">
                    <img src="{{ auth()->guard('etudiant')->user()->image ? asset('storage/' . auth()->guard('etudiant')->user()->image) : asset('img/user-removebg-preview.png') }}" 
                        alt="Pofil" 
                        class="d-block mx-auto rounded object-fit-cover shadow-lg" 
                        style="width: 300px; height: 300px;">
                </div>
            </div>
        </div>
    </div>

@endsection
