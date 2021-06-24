@extends('layouts.auth')

@section('content')
<div class="container p-5">
    <div>
       
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        @if (session('erreur'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('erreur') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    <div class="auth-box">
        <div class="card auth-img">
            <div class="auth-img-p">
                <img src="{{asset('images/login.jpg')}}" alt="" class="my-img">
            </div>
        </div>
        <div class="auth-form">
            <div class="card auth-card">
                <div class="logo">
                    <img src="{{asset('images/logo.png')}}" alt="" class="my-img">
                </div>
                <div class="form-c">
                    <h1>{{ __('Connexion') }}</h1>
                    <h3>{{ __('Heureux de vous revoir') }}</h3>
                    @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                       
                        <div class="form-group w-100 mb-4">
                            <div class="input-div">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="email" class="form-label">Email</label>
                            </div>
                        </div>

                        <div class="form-group w-100 mb-4">
                            
                            <div class="input-div">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 auth-btn">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Me rappeler') }}
                                    </label>
                                </div>
                                <div class="mdpf">
                                    @if (Route::has('password.request'))
                                        <a class="" href="{{ route('password.request') }}">
                                            {{ __('Mot de passe oublier?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mt-5">
                            <div class="col-md-12 auth-btn ">
                                <div class="log">
                                    <a href="{{ route('register') }}" class=""><span>Je n ai pas de compte s inscrire</span></a>
                                </div>
                                <div class="">
                                    <button type="submit" class="btn reg-btn">
                                        {{ __('Se connecter') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
