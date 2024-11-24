@extends('layout.appEtudiant')
@section('content')
<h5>Formation >  Detail</h5>
<div class="row justify-content-center">
            <div class="col-lg-7 col-md-4 col-sm-6 mb-4"> 
              <div class="card small-box">
                @if($formation->image)
                  <div class="text-center">
                    <img src="{{ asset('storage/' . $formation->image) }}" class="card-img-top img-fluid" style="max-width: 100%; height: auto;" alt="{{ $formation->titre }}" />
                  </div>
                @elseif($formation->video) 
                  <div class="text-center"> 
                    <video class="card-img-top img-fluid" controls style="max-width: 100%; height: auto;"> 
                      <source src="{{ asset('storage/' . $formation->video) }}" type="video/mp4"> Votre navigateur ne supporte pas la lecture de vidéos. </video> 
                  </div>
                @else 
                  <div class="text-center">
                    <iframe src="https://youtu.be/IA1gFD1HeQg" class="card-img img-fluid" style="max-width: 100%; height: auto;" alt="Aucune image disponible"></iframe>
                  </div>
                @endif
                <div class="card-body">
                  <div class="inner">
                    <h4>{{ $formation->titre }}</h4>
                    <p>Desciption : {{ $formation->description }}</p>
                    <p>Durée : {{ $formation->duree }} Heures</p>
                    <p><strong>Nombre de chapitres :</strong> {{ $formation->chapitres_count }}</p>
                    <p>Prix : {{ $formation->prix }} XOF</p>
                    <hr color="black" style="height: 1px">

                    <fieldset>
                      <legend>Formateur</legend> 
                        <div class="row"> 
                          <div class="col-8 col-sm-6"> 
                            <div class="col-4"> <!-- Col-4 to align properly --> 
                              <img class="img-profile rounded-circle" src="{{ $formation->formateur->image ? asset('storage/' . auth()->guard('formateur')->user()->image) : asset('img/user-removebg-preview.png') }}"> 
                            </div> 
                          </div> 
                          <div class="col-6"> 
                            <p>{{ $formation->formateur->nom }} {{ $formation->formateur->prenom }}</p>
                            <p>{{ $formation->formateur->bio }}</p>
                          </div>
                        </div>
                    </fieldset>  
                    <hr color="black" style="height: 1px">  
                  </div>
                </div>

                <div class="d-flex justify-content-between p-4">
                    {{-- <a href=" {{ route('forma.detail', ['formation_id' => $formation->id]) }} " class="btn btn-info">Plus d'info</a>  --}}
                    <a href=" {{ route('etudiant.achat', ['formation_id' => $formation->id]) }} " class="btn btn-primary">Acheter</a>
                </div>
              </div>
            </div>
</div>
@endsection