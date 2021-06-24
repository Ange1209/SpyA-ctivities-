@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-12 col-md-12">
            <div class="auth-box">
                <div class="card auth-img">
                    <div class="auth-img-p">
                        <img src="{{asset('images/inscrip.jpg')}}" alt="" class="img-fluid">
                    </div>
                </div>
                <div class="auth-form ">
                    <div class="card auth-card">
                        <div class="logo">
                            <img src="{{asset('images/logo.png')}}" alt="" class="img-fluid">
                        </div>
                        <div class="form-r">
                            <h2>{{ __('Inscription') }}</h2>
                            <h4>{{ __('Bienvenue sur SpyActivities') }}</h4><br>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group w-100 mb-3">
                                    
                                    <div class="input-div ">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                        
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="name" class="form-label">{{ __('Nom') }}</label>
                                    </div>
                                </div>
                                <div class="form-group w-100 mb-3">
                                    <div class="input-div">
                                        <select id="departement"  class="form-control @error('departement') is-invalid @enderror" name="departement"  required autofocus>
                                            {{-- <option value="">Département</option> --}}
                                            @foreach ($departements as $item)
                                            <option value="{{$item->uuid}}"  {{ (old('departement') == $item->uuid) ? "selected" : ""  }}>{{$item->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('departement')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="name" class="form-label">{{ __('Departement') }}</label>
                                    </div>    
                                </div>
            
                                <div class="form-group w-100 mb-3">
                                    <div class="input-div">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                        
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="email" class="form-label">{{ __('E-Mail') }}</label>
                                    </div>
                                </div>
                                
                                <div class="form-group w-100 mb-3">
                                    <div class="input-div">
                                        <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                        
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="phone" class="form-label">{{ __('Telephone') }}</label>
                                    </div>
                                </div>
            
                                <div class="form-group w-100 mb-3">
                                    
                                    <div class="input-div">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                        <label for="password" class="form-label">{{ __('Mot de passe') }}</label>
                                    </div>
                                </div>
            
                                <div class="form-group w-100 mb-3">
                                    
                                    <div class="input-div">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        <label for="password-confirm" class="form-label">{{ __('Confirmer le mot de passe') }}</label>
                                    </div>
                                </div>
            
                                <div class="form-group row mb-3">
                                    <div class="col-md-12 auth-btn ">
                                        <div class="log">
                                            <a href="{{ route('login') }}" class=""><span>J ai deja un compte se connecter</span></a>
                                        </div>
                                        <div class="">
                                            <button type="submit" class="btn reg-btn">
                                                {{ __('S inscrire') }}
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
    </div>
</div>
@endsection
