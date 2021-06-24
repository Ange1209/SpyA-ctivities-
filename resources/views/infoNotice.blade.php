@extends('layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-12">
                <div class="card notice">
                    <div class="logo">
                        <img src="{{asset('images/logo.png')}}" alt="" class="img-fluid">
                    </div>
                    <div class="notice-text">
                        <h5>Impossible de vous connecter! Votre compte a été bloqué. Veuillez contacter l'administrateur merci</h5>
    
                        <h5><a class="" href="/">
                         {{ __('Quitter') }}
                        </a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection