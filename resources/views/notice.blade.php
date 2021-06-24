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
                        <h5>Votre compte a bien été créé. Vous recevrez un mail de validation de votre manager, vous pourrez ensuite vous connecter merci</h5>
    
                        <h5><a class="" href="/">
                         {{ __('Quitter') }}
                        </a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection