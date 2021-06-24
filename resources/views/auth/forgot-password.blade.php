{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

     
        <x-auth-session-status class="mb-4" :status="session('status')" />

   
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

           
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}



@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center ">
        <div class="col-12 col-md-8">
            <div class="auth-box">
                <div class="forget-form ">
                    <div class="card auth-card">
                        <div class="logo">
                            <img src="{{asset('images/logo.png')}}" alt="" class="img-fluid">
                        </div>
                        <div class="form">
                            <h5>{{ __('Vous avez oubliez votre mot de passe? Ne vous inquieter pas, laisser nous votre email nous vous ferons parvenir un lien qui vous permetras de changer votre mot de passe.') }}</h5><br>

                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('password.email') }}">
                                @csrf
            
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
                              
                                <div class="form-group row mb-3">
                                    <div class="col-md-12 auth-btn ">
                                        <div class="">
                                            <button type="submit" class="btn reg-btn">
                                                {{ __('Envoyer') }}
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
