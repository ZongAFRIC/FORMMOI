@foreach ($formations as $form)
    <div class="col-lg-3 col-md-4 col-sm-6 mb-4"> 
        <div class="card small-box">
            <img src="{{ $form->image ? asset('storage/' . $form->image) : asset('img/nn.png') }}" 
                 class="img-fluid" alt="Aucune image disponible" />
            <div class="card-body">
                <div class="inner">
                    <h4>{{ $form->titre }}</h4>
                    <p>Durée : {{ $form->duree }} Heures</p>
                </div>
                <div class="d-flex justify-content-between">
                    <p>
                        <a href="{{route('register')}}">Inscrivez-vous</a> 
                        ou 
                        <a href="{{route('login')}}">connectez-vous</a> 
                        pour bénéficier de nos offres
                    </p>
                </div>
            </div>
        </div>
    </div>
@endforeach
